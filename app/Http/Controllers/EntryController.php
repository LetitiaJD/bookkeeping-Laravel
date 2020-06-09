<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;
use App\Account;
use App\Category;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $entriesPerPage = isset($request['entriesPerPage']) ? $request['entriesPerPage'] : 1;

        $user = Auth::user();
        $account_ids = [];

        foreach($user->accounts as $account){
            array_push($account_ids, $account->pivot->account_id);
        }

        $values = implode(",", $account_ids);

        $entries = Entry::whereRaw('account_id IN ' .'(' . $values .')')->paginate($entriesPerPage);

        //$entries = Entry::paginate($entriesPerPage);

        return view('entry.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Required for select dropdown to select an account
        // Remove once login has been implemented
        $accounts = Account::all();

        $categories = Category::all();

        return view('entry.create', compact('accounts', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'entry_date.date' => 'Das Eintragsdatum muss das Format \'tt.mm.jjjj\' haben.',
            'entry_date.required' => 'Das Eintragsdatum muss angegeben sein.',
            'entry_description.required' => 'Der Kontotyp muss angegeben werden.',
            'entry_description.max' => 'Die Beschreibung darf nicht mehr als 255 Zeichen umfassen.',
            'entry_description.alpha_num' => 'Die Beschreibung darf nur aus alphanumerischen Zeichen bestehen.',
            'entry_amount.required' => 'Der Betrag muss angegeben sein.'
        ];

        $validator = $request->validate([
            'entry_date' => 'required|date',
            'entry_description' => 'required|max:255|alpha_num',
            'entry_amount' => 'required|min:0|regex:/^(\d+(?:[\.\,]\d{2})?)$/',
        ], $messages);

        $entry = new Entry();

        // TODO Do this the laravel way using relationships
        $account = DB::table('account')->where('account_holder', $request['account_holder'])->first();
        $account_id = $account->account_id;

        $category = DB::table('category')->where('category_name', $request['category_name'])->first();
        $category_id = $category->category_id;

        $entry->account_id = $account_id;
        $entry->category_id = $category_id;
        $entry->entry_date = $request['entry_date'];
        $entry->entry_description = $request['entry_description'];
        $entry->entry_amount = str_replace(',', '.', $request['entry_amount']);
        $entry->save();

        return redirect()->route('entry.index')->with('success', 'Der Eintrag wurde erfolgreich gespeichert');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Entry::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    * Returns selected rows of table based on searchTerm and date range
    * Called via ajax on index
    */
    public function filter(Request $request)
    {
        $entries = new Entry();
        $entriesPerPage = isset($request['entriesPerPage']) ? $request['entriesPerPage'] : 10;

        if(isset($request['startDate']) && !empty( $request['startDate'])) {
            $entries = $entries->where('entry_date', '>=', $request['startDate']);
        }
        if(isset($request['endDate']) && !empty( $request['endDate'])) {
            $entries = $entries->where('entry_date', '<=', $request['endDate']);
        }
        if(isset($request['searchTerm']) && !empty( $request['searchTerm'])) {
             $entries = $entries->where('entry_description', 'LIKE', '%' . $request['searchTerm'] . '%');
        }

        $entries = $entries->orderBy('entry_date', 'asc')->paginate($entriesPerPage);

        if($entries->isEmpty()){
            echo '<tr><td colspan="6">Keine Ergebnisse gefunden.</td></tr>';
            return;
        }

        $view = View::make('entry.index')->with('entries', $entries);

        $sections = $view->renderSections();
        return $sections['tableWithPagination'];
    }
}

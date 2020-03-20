<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;
use App\Account;
use App\Category;
use DB;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Entry::all();

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
}

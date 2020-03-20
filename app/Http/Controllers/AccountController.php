<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::all();

        return view('account.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.create');
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
            'account_type.required' => 'Der Kontotyp muss angegeben werden.',
            'account_type.max' => 'Der Kontotyp darf nicht mehr als 255 Zeichen umfassen.',
            'account_type.alpha_num' => 'Der Kontotyp darf nur aus alphanumerischen Zeichen bestehen.',
            'account_holder.required' => 'Der Kontoinhaber muss angegeben werden.',
            'account_holder.max' => 'Der Kontoinhaber darf nicht mehr als 255 Zeichen umfassen.'
        ];

        $validator = $request->validate([
            'account_type' => 'required|max:255|alpha_num',
            'account_holder' => 'required|max:255|unique:account,account_holder'
        ], $messages);

        $account = Account::create($request->all())->save();

        return redirect()->route('account.index')->with('success', 'Das Konto wurde erfolgreich gespeichert');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Account::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::findOrFail($id);

        return view('account.edit', compact('account'));
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
        $account = Account::findOrFail($id);
        $account->account_type = $request->account_type;
        $account->account_holder = $request->account_holder;
        $account->save();

        return redirect()->route('category.index')->with('success', 'Die Kategorie wurde erfolgreich hinzugefügt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->route('account.index')->with('success', 'Das Konto wurde erfolgreich gelöscht');
    }
}

@extends('base')

@section('main')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div>
        <h3>Transaktion hinzufügen</h3>
    </div>

    <form method="post" action="{{ route('entry.store') }}">
        @csrf
        <div class="form-group row">
            <div class="col-sm-4">
                <label for="account_holder">Konto auswählen</label>
                <select class="form-control" id="account_holder" name="account_holder">
                    @foreach ($accounts as $account)
                        <option>{{ $account->account_holder }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label for="select_account">Kategorie auswählen</label>
                <select class="form-control" id="category_name" name="category_name">
                    @foreach ($categories as $category)
                        <option>{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label for="entry_date">Eintragsdatum</label>
                <input type="date" class="form-control" name="entry_date" id="entry_date" aria-describedby="entry_date" placeholder="tt.mm.jjjj">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label for="entry_description">Beschreibung</label>
                <input type="text" class="form-control" name="entry_description" id="entry_description" aria-describedby="entry_description" placeholder="z.B. ">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label for="entry_amount">Betrag</label>
                <input type="text" class="form-control" name="entry_amount" id="entry_amount" aria-describedby="entry_amount" placeholder="z.B. 2,00 ">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Eintrag hinzufügen</button>
    </form>

@endsection

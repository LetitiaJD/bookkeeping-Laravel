@extends('base')

@section('main')

    <form method="post" action="{{ url('account/'. $account->account_id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="account_type">Kontotyp</label>
            <input type="text" class="form-control" name="account_type" id="account_type" aria-describedby="account_type" value="{{ $account->account_type}}">
        </div>

        <div class="form-group">
            <label for="account_holder">Kontoinhaber</label>
            <input type="text" class="form-control" name="account_holder" id="account_holder" value="{{ $account->account_holder}}">
        </div>

        <button type="submit" class="btn btn-primary">Änderung übernehmen</button>
    </form>

@endsection

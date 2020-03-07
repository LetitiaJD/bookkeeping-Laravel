@extends('base')

@section('main')

    <form method="post" action="{{ route('account.store') }}">
        @csrf
        <div class="form-group">
            <label for="account_type">Kontotyp</label>
            <input type="text" class="form-control" name="account_type" id="account_type" aria-describedby="account_type" placeholder="z.B. Giro, Sparkonto">
        </div>

        <div class="form-group">
            <label for="account_holder">Kontoinhaber</label>
            <input type="text" class="form-control" name="account_holder" id="account_holder" placeholder="Name">
        </div>

        <button type="submit" class="btn btn-primary">Konto hinzufügen</button>
    </form>

@endsection

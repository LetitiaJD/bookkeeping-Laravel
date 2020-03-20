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

    <form method="post" action="{{ route('account.store') }}">
        @csrf
        <div class="form-group">
            <label for="account_type">Kontotyp</label>
            <input type="text" class="form-control" name="account_type" id="account_type"
                aria-describedby="account_type" placeholder="z.B. Giro, Sparkonto" value="{{ $account->account_type ?? ''}}">
        </div>

        <div class="form-group">
            <label for="account_holder">Kontoinhaber</label>
            <input type="text" class="form-control" name="account_holder" id="account_holder" placeholder="Name">
        </div>

        <button type="submit" class="btn btn-primary">Konto hinzufügen</button>
    </form>

@endsection

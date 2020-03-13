@extends('base')

@section('main')

<div class="row">
    <div class="col-12">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <td>Kontotyp</td>
                    <td>Kontoinhaber</td>
                    <td>Aktionen</td>
                </tr>
            </thead>
            @foreach ($accounts as $account)
                <tr>
                    <td> {{ $account->account_type }} </td>
                    <td> {{ $account->account_holder }} </td>
                    <td>
                        <a href="account/{{$account->account_id}}/edit" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Bearbeiten</a>
                        <form method="post" action="{{ route('account.destroy', $account->account_id) }}" >
                            @method('delete')
                            @csrf
                            <button onclick="return confirm('Möchten Sie diesen Konto wirklich löschen?')"
                                    class="btn btn-danger btn-sm" type="submit">Löschen
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection

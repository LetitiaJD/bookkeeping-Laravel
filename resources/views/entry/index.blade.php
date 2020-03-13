@extends('base')

@section('main')

<div class="row">
    <div class="col-12">
        @if(session('success'))
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
                    <td>Kontoinhaber</td>
                    <td>Kategorie</td>
                    <td>Eintragsdatum</td>
                    <td>Beschreibung</td>
                    <td>Betrag</td>
                    <td>Aktionen</td>
                </tr>
            </thead>
            @foreach ($entries as $entry)
                <tr>
                    <td> {{ $entry->account->account_holder }} </td>
                    <td> {{ $entry->category->category_name }} </td>
                    <td> {{ $entry->entry_date->format('d M Y') }} </td>
                    <td> {{ $entry->entry_description }} </td>
                    <td> {{ number_format($entry->entry_amount, 2, ',', '.') }} €</td>
                    <td>
                        <a href="{{ route('entry.edit', $entry->entry_id) }}" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Bearbeiten</a>
                        <form method="post" action="{{ route('entry.destroy', $entry->entry_id) }}">
                            @method('delete')
                            @csrf
                            <button onclick="return confirm('Möchten Sie diesen Eintrag wirklich löschen?')"
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

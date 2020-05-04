@section('tableWithPagination')

<div id="tableWithPagination">
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-bordered" id="entriesTable">
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
                <tbody>

                    @foreach ($entries as $entry)
                    <tr>
                        <td> {{ $entry->account->account_holder }} </td>
                        <td> {{ $entry->category->category_name }} </td>
                        <td> {{ $entry->entry_date->format('d M Y') }} </td>
                        <td> {{ $entry->entry_description }} </td>
                        <td> {{ number_format($entry->entry_amount, 2, ',', '.') }} €</td>
                        <td>
                            <a href="{{ route('entry.edit', $entry->entry_id) }}" class="btn btn-primary btn-sm active floated" role="button" aria-pressed="true">Bearbeiten</a>
                            <form method="post" action="{{ route('entry.destroy', $entry->entry_id) }}">
                                @method('delete')
                                @csrf
                                <button onclick="return confirm('Möchten Sie diesen Eintrag wirklich löschen?')"
                                class="btn btn-danger btn-sm floated" type="submit">Löschen</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            {{ $entries->links() }}
        </div>
    </div>

</div>

@endsection

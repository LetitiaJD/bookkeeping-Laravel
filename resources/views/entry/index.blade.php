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

<div class="row bottom-gap">
    <div class="col-12">
        <a class="btn btn-success" href="{{ route('entry.create') }}" role="button">+ Neue Transaktion</a>
    </div>
</div>

<div>
    <form>
        <div class="form-row align-items-center">
            <div class="col-auto">
                <label class="sr-only" for="calendarRange"></label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                    </div>

                    <input type="text" class="form-control" id="calendarRange" placeholder="Zeitraum">
                </div>
            </div>

            <div class="col-auto">
                <label class="sr-only" for="inlineFormInputGroup">Username</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>

                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                </div>
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">Suchen</button>
            </div>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-12">
        <table class="table table-striped table-bordered">
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>

@endsection

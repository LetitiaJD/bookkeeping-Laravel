@extends('base')

@section('main')
@include('entry.tableWithPagination')
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
        <div class="form-row align-items-center justify-content-between">
            <div class="col-auto">
                <div class="input-group mb-2">
                    <label for="entriesPerPage">Anzeige </label>
                    <select id="entriesPerPage" class="form-control form-control-sm">
                        <option selected>1</option>
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                    </select>
                    <label for="entriesPerPage">Einträge</label>
                </div>
            </div>

            <div class="col-auto">
                <div class="row no-gutters">
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

                    <div class="col-auto" style="margin:0 10px;">
                        <label class="sr-only" for="inlineFormInputGroup">Username</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>

                            <input type="text" class="form-control" id="searchInput" placeholder="Suchen">
                        </div>
                    </div>

                    <div class="col-auto">
                        <button type="button" id="refreshBtn" class="btn btn-primary mb-2">Aktualisieren</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@yield('tableWithPagination')

@endsection

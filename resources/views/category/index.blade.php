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
        <a class="btn btn-success" href="{{ route('category.create') }}" role="button">+ Neue Kategorie</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <td>Kategorie</td>
                    <td>Aktionen</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td> {{ $category->category_name }} </td>
                        <td>
                            <a href="{{ route('category.edit', $category->category_id) }}" class="btn btn-primary btn-sm active floated" role="button" aria-pressed="true">Bearbeiten</a>
                            <form method="post" action="{{ route('category.destroy', $category->category_id) }}">
                                @method('delete')
                                @csrf
                                <button onclick="return confirm('Möchten Sie diese Kategorie wirklich löschen?')"
                                        class="btn btn-danger btn-sm floated" type="submit">Löschen
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>   
        </table>
    </div>
</div>

@endsection

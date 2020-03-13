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
                    <td>Kategorie</td>
                    <td>Aktionen</td>
                </tr>
            </thead>
            @foreach ($categories as $category)
                <tr>
                    <td> {{ $category->category_name }} </td>
                    <td>
                        <a href="{{ route('category.edit', $category->category_id) }}" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Bearbeiten</a>
                        <form method="post" action="{{ route('category.destroy', $category->category_id) }}">
                            @method('delete')
                            @csrf
                            <button onclick="return confirm('Möchten Sie diese Kategorie wirklich löschen?')"
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

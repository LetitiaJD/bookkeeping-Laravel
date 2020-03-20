@extends('base')

@section('main')

    <form method="post" action="{{ route('category.store') }}">
        @csrf
        <div class="form-group">
            <label for="category_name">Kategorie</label>
            <input type="text" class="form-control" name="category_name" id="category_name"
                aria-describedby="category_name" placeholder="z.B. Auto, Essen" value="{{ $category->category_name ?? ''}}">
        </div>

        <button type="submit" class="btn btn-primary">Kategorie hinzufügen</button>
    </form>

@endsection

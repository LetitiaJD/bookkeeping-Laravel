@extends('base')

@section('main')

    <form method="post" action="{{ url('category/'. $category->category_id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="category_name">Kategorie</label>
            <input type="text" class="form-control" name="category_name" id="category_name" aria-describedby="category_name" value="{{ $category->category_name }}">
        </div>

        <button type="submit" class="btn btn-primary">Änderung speichern</button>
    </form>

@endsection

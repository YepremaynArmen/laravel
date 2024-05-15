@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Создать категорию</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Название категории</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="parent_id" class="form-label">Родительская категория</label>
            <select class="form-select" id="parent_id" name="parent_id">
                <option value="">Нет родительской категории</option>
                @foreach ($categoryList as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
</div>
@endsection
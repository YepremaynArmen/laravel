{{-- resources/views/categories/edit.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Редактировать категорию: {{ $category->name }}</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Название категории</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
        </div>
        <div class="mb-3">
            <label for="parent_id" class="form-label">Родительска я категория</label>
            <select class="form-select" id="parent_id" name="parent_id">
                <option value="">Нет родительской категории</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @if($cat->id == $category->parent_id) selected @endif>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
</div>
@endsection
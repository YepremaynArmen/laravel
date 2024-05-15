{{-- В файле resources/views/photos/create.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Добавить новую фотографию</h1>
    <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Выберите изображение</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Категория</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Выберите категорию</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Загрузить</button>
    </form>
</div>
@endsection        
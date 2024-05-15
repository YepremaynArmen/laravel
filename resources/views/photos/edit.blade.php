{{-- resources/views/photos/edit.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Редактировать фотографию</h1>
    <form action="{{ route('photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Название</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $photo->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $photo->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Категория</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Выберите категорию</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $photo->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Изображение</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($photo->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $photo->image) }}" alt="Current image" style="max-width: 100px;">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</div>
@endsection
                
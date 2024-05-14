@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Добавить новую фотографию</h1>
    <form action="{{ route('photos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="image">Выберите изображение</label>
            <select class="form-control" id="image" name="image_path">
                @foreach ($files as $file)
                <option value="{{ $file }}">{{ $file }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
</div>
@endsection
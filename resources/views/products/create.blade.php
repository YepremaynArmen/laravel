{{-- resources/views/products/create.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Добавить новый товар</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
           <label for="name">Название товара:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Описание:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Категория:</label>
            <select class="form-control" id="category_id" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
@endsection
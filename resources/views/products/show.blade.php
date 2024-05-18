@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <!-- Дополнительные детали продукта -->
    <a href="{{ route('products.index') }}" class="btn btn-primary">Вернуться к списку</a>
    <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary">Редактировать</a>
    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Удалить</button>
    </form>
</div>
@endsection
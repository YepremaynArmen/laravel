{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Список товаров</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Добавить товар</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Категория</th>
                <th>Актуальная цена</th>
                <th>Дата цены</th>                
                
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->category ? $product->category->name : 'Нет категории' }}</td>
                <td>{{ $product->current_price }}</td>
                <td>{{ $product->current_price_date }}</td>                
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-secondary">Редактировать</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот товар?');">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
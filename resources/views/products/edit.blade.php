@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Редактировать продукт</h1>
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Название:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Описание:</label>
            <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Категория:</label>
            <select class="form-control" id="category_id" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Обновить</button>
        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Отмена</button>
    </form>
</div>

<a href="#" class="btn btn-primary" onclick="$('#priceModal').modal('show');">Добавить цену</a>
<!-- Модальное окно для добавления новой цены -->
<div class="modal fade" id="priceModal" tabindex="-1" role="dialog" aria-labelledby="priceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('prices.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="priceModalLabel">Новая цена</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="price">Цена:</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Дата:</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>                    
            </div>
        </form>
    </div>
</div>

<h3>Цены товара</h3>
<table class="table">
    <thead>
        <tr>
            <th>Цена</th>
            <th>Дата</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($product->prices as $price)
        <tr>
            <td>{{ $price->price }}</td>
            <td>{{ $price->date }}</td>
            <td>
                <form action="{{ route('prices.destroy', $price->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить эту цену?');">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
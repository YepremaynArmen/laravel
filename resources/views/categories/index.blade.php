{{-- resources/views/categories/index.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Категории</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Добавить новую категорию</a>
    @include('components.category', ['categories' => $categories])
</div>
@endsection
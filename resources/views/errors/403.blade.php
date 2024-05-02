@extends('layouts.app')

@section('title', 'Нет доступа')

@section('content')
<div class="container text-center">
    <h1>403 - Нет доступа</h1>
    <p>Извините, у вас нет прав для доступа к этой странице.</p>
    <a href="{{ url()->previous() }}">Вернуться назад</a>
</div>
@endsection
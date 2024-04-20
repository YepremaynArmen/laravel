{{-- resources/views/new_index.blade.php --}}
@extends('layouts.main')
@section('title', 'Главная страница')
@section('header')
    Добро пожаловать на мою страницу!
@endsection
@section('content')
    <p>Это главная страница моего сайта, здесь вы можете найти различную информацию.</p>
    <p>Если вам нужно связаться с нами, посетите нашу <a href="{{ url('/contacts') }}">страницу контактов</a>.</p>
@endsection
@section('footer')
    © 2024 Мой сайт. Все права защищены.
@endsection
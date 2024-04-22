{{-- resources/views/new_index.blade.php --}}
@extends('layouts.main')
@section('title', 'Главная страница')
@section('header')
    Добро пожаловать на мою страницу!
@endsection
@section('content')
    <p>Это главная страница моего сайта, здесь вы можете найти различную информацию.</p>
    <p>Чтобы узнать о нас подробнее посетите нашу <a href="{{ url('/about') }}">страницу О нас</a>.</p>
@endsection
@section('footer')
    © 2024 Мой сайт. Все права защищены.
@endsection
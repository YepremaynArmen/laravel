{{-- resources/views/users/show.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Просмотр пользователя: {{ $user->name }}</h1>
    <ul>
        <li>ID: {{ $user->id }}</li>
        <li>Имя: {{ $user->name }}</li>
        <li>Дата рождения: {{ $user->birthdate }}</li>
        <li>Email: {{ $user->email }}</li>
        <!-- Другая информация о пользователе -->
    </ul>
    <a href="{{ route('users.index') }}">Вернуться к списку пользователей</a>
</div>
@endsection
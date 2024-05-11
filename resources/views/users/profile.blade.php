@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Личный кабинет</h1>
        <p>ID пользователя: {{ $userId }}</p>
        <p>Роли пользователя: {{ implode(', ', $roles) }}</p>
    </div>
@endsection
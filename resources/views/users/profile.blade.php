{{-- resources/views/users/create.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Добавить пользователя</h1>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div>
            <label for="name">Имя:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label for="birthdate">Дата рождения:</label>
            <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}" required>
        </div>
        <div>
            <label for="login">Логин:</label>
            <input type="text" name="login" id="login" value="{{ old('login') }}" required>
        </div>
        <div>
            <label for="email">email:</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" value="{{ old('password') }}" required>
        </div>
        <button type="submit">Добавить пользователя</button>
    </form>
</div>
@endsection
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- Форма... -->
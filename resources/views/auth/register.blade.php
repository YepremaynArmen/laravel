<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        {{-- Показать ошибки валидации --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Форма регистрации --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf
            {{-- Имя пользователя --}}
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            {{-- Электронная почта --}}
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            {{-- Пароль --}}
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="new-password">
            </div>
            {{-- Подтверждение пароля --}}
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            {{-- Кнопка отправки формы --}}
            <div>
                 <button type="submit">Register</button>
            </div>
        </form>
    </div>
</body>
</html>

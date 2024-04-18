    {{-- resources/views/users/edit.blade.php --}}
    @extends('layouts.app')

    @section('content')
        <h1>Редактирование пользователя</h1>

        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT') <!-- Или @method('PATCH') -->

        <div>
            <label for="name">Имя:</label>
            <input type="text" name="name" value="{{ $user->name }}" required>
        </div>
        <div>
            <label for="birthdate">Дата рождения:</label>
            <input type="date" name="birthdate" id="birthdate" value="{{ $user->birthdate }}" required>
        </div>
        <div>
            <label for="login">Логин:</label>
            <input type="text" name="login" id="login" value="{{ $user->login }}" required>
        </div>
        <div>
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" value="{{ $user->password }}" required>
        </div>            
            
            
            
            
            
            
            
            
            
            
            
            

            <button type="submit">Сохранить изменения</button>
        </form>
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
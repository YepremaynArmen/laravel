{{-- resources/views/users/index.blade.php --}}
@can('view-users-page', auth()->user())
    {{-- Код для отображения страницы /users, если пользователь авторизован и имеет право её просмотра --}}
@else
    {{-- Сообщение или код для пользователей без права просмотра страницы /users --}}
@endcan
@extends('layouts.app')
@section('content')
<h1>Список пользователей</h1> 
<a href="{{ route('users.create') }}" class="btn btn-primary">Добавить пользователя</a>
<table> 
    <tr> 
        <th>ID</th> 
        <th>Имя</th> 
        <th>Дата рождения</th> 
        <th>Логин</th> 
        <th>Действия</th> 
    </tr> @foreach ($users as $user) 
    <tr> 
        <td>{{ $user->id }}</td> 
        <td>{{ $user->name }}</td> 
        <td>{{ $user->birthdate }}</td> 
        <td>{{ $user->login }}</td> 
        <td> 
            <a href="{{ route('users.show', $user->id) }}">Просмотр
            </a> 
            <a href="{{ route('users.edit', $user->id) }}">Редактировать
            </a> 
            <form action="{{ route('users.destroy', $user->id) }}" method="POST"> @csrf @method('DELETE') 
                <button type="submit">Удалить
                </button> 
            </form> 
        </td> 
    </tr> @endforeach 
</table> 
@endsection
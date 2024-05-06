@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Пользователи</h1>
    <td>
        @can('create users', \Spatie\Permission\Models\User::class)
            <a href="{{ route('users.create') }}">Добавить нового пользователя</a>
        @endcan
    </td>       
    <table>
        <thead>
            <tr>
                <th>Имя</th>
                <th>Email</th>
                <th>Роли</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->join(', ') }}</td>
                    <td>
                        @can('assign role', \Spatie\Permission\Models\User::class)
                            <form action="{{ route('users.assign_role', $user) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit">Назначить роль</button>
                            </form>
                        @endcan 
                            <td>
                                @can('edit users', \Spatie\Permission\Models\User::class)
                                    <a href="{{ route('users.edit', $user->id) }}">Редактировать</a>
                                @endcan                        
                            </td>
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            <td>
                                @can('delete users', \Spatie\Permission\Models\User::class)
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить запись?')">Удалить</button>
                                @endcan
                            </td>                            
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

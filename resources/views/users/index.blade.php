@extends('layouts.app')

@section('content')
<style>
    th a {
        color: inherit; /* Цвет ссылок как у текста */
        text-decoration: none; /* Убираем подчеркивание ссылок */
    }
    th a.active {
        color: #FF0000; /* Красный цвет для активной колонки */
    }
</style>
<form action="{{ route('users.index') }}" method="GET" id="searchForm">
    <input type="text" name="search" id="searchField" placeholder="Поиск по имени" value="{{ request('search') }}">
    {{-- Кнопка для очистки поля ввода --}}
    <button type="button" onclick="clearSearchField()" style="margin-left: -25px; cursor: pointer;">&times;</button>
    <button type="submit">Поиск</button>
    
    <select name="role">
        <option value="">Выбрать роль</option>
        @foreach ($roles as $id => $name)
            <option value="{{ $id }}"{{ request('role') == $id ? ' selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
</form>
<script>
// Функция для очистки поля ввода и отправки формы
function clearSearchField() {
    document.getElementById('searchField').value = '';
    document.getElementById('searchForm').submit();
}
</script>

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
                <th>
                    <a href="{{ route('users.index', ['sort' => 'name', 'direction' => request('direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}" class="{{ request('sort') === 'name' ? 'active' : '' }}">Имя</a>
                </th>
                <th>
                    <a href="{{ route('users.index', ['sort' => 'email', 'direction' => request('direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}" class="{{ request('sort') === 'email' ? 'active' : '' }}">Email</a>
                </th>
                <th>
                    Роли {{-- Ссылку для сортировки по ролям добавить сложнее из-за связи "многие ко многим" --}}
                </th>
                <th>
                    <a href="{{ route('users.index', ['sort' => 'created_at', 'direction' => request('direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}" class="{{ request('sort') === 'created_at' ? 'active' : '' }}">Дата регистрации</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->join(', ') }}</td>
                    <td>{{ $user->created_at->format('d.m.Y') }}</td>
                    <td>
                        @can('assign role', \Spatie\Permission\Models\User::class)
                            <form action="{{ route('users.assign_role', $user) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="role">
                                    @foreach ($roles as $id => $name)
                                        <option value="{{ $id }}" {{ (int) request('role') === $id ? 'selected' : '' }}>
                                            {{ $name }}
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
            
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif            
            
            
        </tbody>
    </table>
</div>
@endsection

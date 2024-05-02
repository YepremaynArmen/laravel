@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактирование роли: {{ $role->name }}</h1>
    <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Имя роли:</label>
            <input type="text" name="name" id="name" value="{{ $role->name }}" required>
        </div>

        <div>
            <h3>Назначить разрешения:</h3>
            @foreach ($permissions as $permission)
                <div>
                    <label>
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit">Обновить роль</button>
    </form>
</div>
@endsection

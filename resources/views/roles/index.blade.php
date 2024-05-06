@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Роли</h1>
    @can('create role', \Spatie\Permission\Models\Role::class)
        <a href="{{ route('roles.create') }}">Создать новую роль</a>
    @endcan    
    <table class="table">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Разрешения</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        <details>
                            <summary>Просмотреть разрешения</summary>
                            <ul>
                                @foreach ($role->permissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>
                        </details>
                    </td>
                    <td>
                        @can('edit role', \Spatie\Permission\Models\Role::class)
                            <a href="{{ route('roles.edit', $role->id) }}">Редактировать</a>
                        @endcan                        
                    </td>
                    <td>
                        <form action="{{ route('roles.destroy', ['role' => $role->id]) }}" method="POST">
                          @can('delete role', \Spatie\Permission\Models\Role::class)
                          @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить запись?')">Удалить</button>
                          @endcan
                        </form>    
                      </td>                        
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

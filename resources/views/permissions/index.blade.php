{{-- Список разрешений --}}
{{-- resources/views/permissions/index.blade.php--}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Разрешения</h1>
    <a href="{{ route('permissions.create') }}">Создать новое разрешение</a>
    <ul>
        @foreach ($permissions as $permission)
            <li>
                {{ $permission->name }}
                <a href="{{ route('permissions.edit', $permission->id) }}">Редактировать</a>
                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Удалить</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection

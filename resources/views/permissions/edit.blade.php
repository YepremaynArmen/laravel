{{-- Форма редактирования разрешения --}}
{{-- resources/views/permissions/edit.blade.php--}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактирование разрешения: {{ $permission->name }}</h1>
    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Имя разрешения:</label>
            <input type="text" name="name" id="name" value="{{ $permission->name }}" required>
        </div>
        <button type="submit">Обновить</button>
    </form>
</div>
@endsection

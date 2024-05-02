{{-- Форма создания роли --}}
{{-- resources/views/roles/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Создание новой роли</h1>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Имя роли:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <button type="submit">Создать</button>
    </form>
</div>
@endsection

{{-- Форма создания разрешения --}}
{{-- resources/views/permissions/create.blade.php--}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Создание нового разрешения</h1>
    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Имя разрешения:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <button type="submit">Создать</button>
    </form>
</div>
@endsection

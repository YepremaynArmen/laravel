{{-- resources/views/loads/index.blade.php --}}
@extends('layouts.app')
@section('header')
    Загруска файла на сервер
@endsection
@section('content')
<!-- Предполагается, что вы помещаете этот код в представление, доступное авторизованным пользователям -->
<form action="/upload" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" />
    <button type="submit">Загрузить файл</button>
</form>
@endsection

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        @if (session('file'))
            <p>Загруженный файл: {{ session('file') }}</p>
        @endif
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
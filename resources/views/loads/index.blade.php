{{-- resources/views/loads/index.blade.php --}}
@extends('layouts.app')
@section('header')
    Загруска файла на сервер
@endsection

@section('files')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                @if (session('file'))
                    <p>Загруженный файл: <a href="{{ asset('storage/uploads/' . session('file')) }}" target="_blank">{{ session('file') }}</a></p>
                @endif
            </div>
        @endif
        <h2>Список файлов</h2>
        @if (count($files) > 0)
            <ul>
                @foreach ($files as $file)
                    <li><a href="{{ asset('storage/uploads/' . $file) }}" target="_blank">{{ $file }}</a></li>
                @endforeach
            </ul>
        @else
            <p>Файлы не найдены.</p>
        @endif
    </div>


    <!-- Предполагается, что вы помещаете этот код в представление, доступное авторизованным пользователям -->
    <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" />
        <button type="submit">Загрузить файл</button>
    </form>
@endsection

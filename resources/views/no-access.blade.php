{{-- resources/views/no-access.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Доступ запрещён</h1>
    <p>У вас нет прав для доступа к этой странице.</p>
    <a href="{{ url()->previous() }}">Вернуться назад</a>
</div>
@endsection

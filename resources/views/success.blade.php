{{-- resources/views/success.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="alert alert-success" role="alert">
        Ваше сообщение было успешно отправлено.
    </div>
    <a href="{{ url('/') }}">Вернуться на главную страницу</a>
</div>
@endsection
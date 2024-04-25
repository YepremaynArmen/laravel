{{-- resources/views/contacts.blade.php --}}
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@extends('layouts.main')
@section('title', 'Контакты')
@section('header')
    <h1>Связаться с нами</h1>
@endsection
@section('content')
    <x-alert type="warning">
        В связи с пандемией наш офис временно закрыт для посещений.
    </x-alert>
    <x-banner type="info" message="Узнайте о нашей истории и ценностях">
        <strong>Мы все еще стремимся к постоянному совершенствованию!</strong>
    </x-banner>
    <p>Если у вас есть вопросы, пожалуйста, заполните форму ниже, и мы свяжемся с вами как можно скорее.</p>
    <form method="POST" action="{{ route('contacts.send') }}">
        @csrf
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="subject">Тема:</label>
        <input type="text" id="subject" name="subject" required><br>        
        
        <label for="message">Сообщение:</label>
        <textarea id="message" name="message" required></textarea><br>
        <button type="submit">Отправить</button>
    </form>
@endsection
@section('footer')
    <p>Наш телефон: 123-456-7890</p>
@endsection
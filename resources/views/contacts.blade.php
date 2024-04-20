{{-- resources/views/contacts.blade.php --}}
@extends('layouts.main')
@section('title', 'Контакты')
@section('header')
    <h1>Связаться с нами</h1>
@endsection
@section('content')
    <p>Если у вас есть вопросы, пожалуйста, заполните форму ниже, и мы свяжемся с вами как можно скорее.</p>
    <form method="post" >
        @csrf
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="message">Сообщение:</label>
        <textarea id="message" name="message" required></textarea><br>
        <button type="submit">Отправить</button>
    </form>
@endsection
@section('footer')
    <p>Наш телефон: 123-456-7890</p>
@endsection
@extends('layouts.app')
@section('header')
    Главная страница
@endsection
@section('content')
<!-- Предполагается, что вы помещаете этот код в представление, доступное авторизованным пользователям -->
<form action="{{ route('logout') }}" method="POST">
    @csrf
</form>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Вы авторизованы</div>
                <div class="card-body">
                    Добро пожаловать на наш сайт!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
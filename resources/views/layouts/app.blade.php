{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Ссылки на стили -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
</head>
<body>
    <div id="app">
            <div class="menu-holder-left">
                <div class="menu-left">
                    <a class="nav-link-left1" href="{{ route('roles.index') }}">{{ __('Роли') }}</a> 
                    <a class="nav-link-left1" href="{{ route('users.index') }}">{{ __('Пользователи') }}</a> 
                    <a class="nav-link-left1" href="{{ route('permissions.index') }}">{{ __('Разрешения') }}</a> 
                    <a class="nav-link-left1" href="{{ route('loads.index') }}">{{ __('Загрузки') }}</a> 
                    <a class="nav-link-left1" href="{{ route('categories.index') }}">{{ __('Категории') }}</a> 
                    <a class="nav-link-left1" href="{{ route('products.index') }}">{{ __('Товары') }}</a>
                    <a class="nav-link-left1" href="{{ route('photos.index') }}">{{ __('Фотогалерея') }}</a>

                </div>
             </div>
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="container">

                <!-- Вставьте здесь логотип и ссылки на навигацию, если необходимо -->
                <div class="navbar-nav ml-auto">
                    
                    <!-- Аутентификация и пользовательские ссылки -->
                    @guest
                        <a class="nav-link" href="{{ route('login') }}">{{ ('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ ('Register') }}</a>
                        @endif
                    @else
                   
                        <div class="nav-item dropdown">
<!--                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>-->
                            <a class="nav-link" href="{{ route('users.profile') }}">{{ Auth::user()->name }}</a>
                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"    
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Выход') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
        
        <main class="py-4">
            @yield('files')
        </main>        
    </div>
    <!-- Скрипты -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>                 
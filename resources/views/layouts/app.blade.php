{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Стандартный заголовок')</title>
    <!-- Сюда можно добавить другие мета-теги, стили и скрипты -->
</head>
<body>
    <header>
        <!-- Здесь может быть верхнее меню или другой общий контент -->
        <h1 >Заголовок</h1>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <!-- Здесь может быть подвал сайта -->
    </footer>
    <!-- Сюда можно добавить скрипты, которые нужны на каждой странице -->
</body>
</html>
{{-- resources/views/layouts/main.blade.php --}}
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Мой новый шаблон</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <header>
        <h1>@yield('header')</h1>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>@yield('footer')</p>
    </footer>
</body>
</html>
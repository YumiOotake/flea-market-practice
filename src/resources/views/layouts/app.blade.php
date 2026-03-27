<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>flea market</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <a href="{{ route('items.index') }}" class="header__logo-link">Flea Market</a>
            </div>
            <nav class="header__nav">
                @guest
                    @if (Request::is('login'))
                        <div class="header__nav-item">
                            <a href="{{ route('register') }}" class="header__nav-link">register</a>
                        </div>
                    @elseif(Request::is('register'))
                        <div class="header__nav-item">
                            <a href="{{ route('login') }}" class="header__nav-link">login</a>
                        </div>
                    @endif
                @endguest
                @auth
                    <form action="{{ route('logout') }}" method="post" class="header__nav-item">
                        @csrf
                        <button type="submit" class="header__nav-link">logout</button>
                    </form>
                @endauth

            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>

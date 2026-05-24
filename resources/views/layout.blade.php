<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Default Title')</title>
    @stack('styles')
</head>
<body>
    <nav>
        {{-- Navigation --}}
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        {{-- Footer --}}
    </footer>

    @stack('scripts')
</body>
</html>
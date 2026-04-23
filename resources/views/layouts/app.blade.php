<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
    @stack('styles')
</head>
<body>
    <!-- Header Component -->
    @include('components.header')
    
    <nav>
        {{-- Navigation --}}
    </nav>
    <!-- Show only for authenticated users -->
    @auth   
        @section('sidebar')
            @parent
            @include('layouts.include.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
            <p></p>
        @endsection
    @endauth

    <main>
        @yield('content')
    </main>

    <footer>
        {{-- Footer --}}
    </footer>

    @stack('scripts')
</body>
</html>
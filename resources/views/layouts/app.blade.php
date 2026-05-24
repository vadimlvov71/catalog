<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
    <script src="{{ asset('js/lazyload.js') }}" defer></script>
    @stack('styles')
</head>
<body>
    <!-- Header Component -->
    @include('components.header')
    
    
    <!-- Show only for authenticated users -->
    @auth   
        @section('sidebar')
            @parent
            @include('layouts.include.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
            <p></p>
        @endsection
    @endauth
    <nav>
        {{-- Navigation --}}
        @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    </nav>
    <main>content
        @yield('content')
    </main>

    <footer>Footer
        {{-- Footer --}}
    </footer>

    @stack('scripts')
</body>
</html>
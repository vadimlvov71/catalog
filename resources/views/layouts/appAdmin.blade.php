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
    
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 sidebar bg-light pt-3">
            @auth
                @include('components.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
                <p></p>
            @endauth
            </nav>

            <main class="col-md-9 pt-3">content
                <nav>
                @auth
                {{-- Navigation --}}
                    @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
                 @endauth
                </nav>
                @yield('content')
            </main>
        </div>
    </div>
    <footer>Footer
        {{-- Footer --}}
    </footer>

    @stack('scripts')
</body>
</html>
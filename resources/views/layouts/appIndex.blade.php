<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Default Title')</title>
     @include('components.styles')
    @stack('styles')
</head>
<body>
    <!-- Header Component -->
    @include('components.header')
    
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-12 pt-3">content
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
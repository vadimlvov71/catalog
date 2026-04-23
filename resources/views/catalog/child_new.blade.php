<!DOCTYPE html>
<html>
@extends('layouts.app')
@section('title', $pageTitle)
<body>
    <div class="d-flex" id="wrapper">
        
        <!-- Sidebar -->

            @section('sidebar')
            @parent
            @include('components.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
            @endsection
        

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle">
                    <i class="fas fa-bars"></i> Menu
                </button>
                <span class="navbar-brand ml-3">@yield('title')</span>
            </nav>

            <!-- Main Content -->
            <main class="container-fluid p-4">
                <div class='row' style='padding:16px 0;background:#f4f4f7;'>
                    @foreach ($categories as $category)
                        {{$category->getLocalName($locale)}}

                        {{--   @foreach ($category->getLocalName($locale) as $object) --}}
                        <div class='col-sm-12 category-block'>
                            <a href="{{ route('category', ['locale' => $locale, 'category' => $category->url]) }}">
                                {{ $category->name}}
                            </a>
                        </div>
                        {{--   @endforeach   --}}
                        @if ($category->items)
                            @foreach ($category->items as $items)
                                <div class='col-sm-3'>
                                    <div class='card'>
                                        <div class='title-item'>
                                            @foreach ($items->getLocalName($locale) as $item)
                                                {{$item['name']}}
                                            @endforeach
                                        </div>
                                        <img src="{{url('/images')}}/{{$items->image}}" height="120" style="" alt="{{ $items->name }}">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-light border-top mt-5 py-3">
                <div class="container-fluid text-center">
                    <p class="text-muted m-0">&copy; 2026 My Site. All rights reserved.</p>
                </div>
            </footer>
        </div>

    </div>

    <!-- Bootstrap 4.3 JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>

    <!-- Toggle Sidebar Script -->
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function() {
            document.getElementById("sidebar-wrapper").classList.toggle("d-none");
        });
    </script>

    @stack('scripts')
</body>
</html>
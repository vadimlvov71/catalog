<header class="bg-light border-bottom sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light container-fluid">
        
        <!-- Logo/Brand -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40" class="mr-2">
            <span class="font-weight-bold">MyApp</span>
        </a>

        <!-- Navbar Toggle Button (Mobile) -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            
            <!-- Search Form (Center) -->
            <form class="form-inline mx-auto flex-grow-1 mr-3" method="GET" action="{{ route('home') }}">
                <div class="input-group w-100">
                    <input class="form-control" type="search" placeholder="Search..." name="q" 
                           value="{{ request('q') }}" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right Side Menu -->
            <ul class="navbar-nav ml-auto">
                
                <!-- Language Dropdown -->
                <li class="nav-item dropdown mr-3">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" 
                       role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe mr-2"></i>
                        <span>{{ strtoupper(app()->getLocale()) }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
                        <a class="dropdown-item" href="{{ route('set-locale', 'en') }}">
                            <img src="{{ asset('images/flags/en.png') }}" alt="English" height="20" class="mr-2">
                            English
                        </a>
                        <a class="dropdown-item" href="{{ route('set-locale', 'ru') }}">
                            <img src="{{ asset('images/flags/ru.png') }}" alt="Русский" height="20" class="mr-2">
                            Русский
                        </a>
                        <a class="dropdown-item" href="{{ route('set-locale', 'es') }}">
                            <img src="{{ asset('images/flags/es.png') }}" alt="Español" height="20" class="mr-2">
                            Español
                        </a>
                        <a class="dropdown-item" href="{{ route('set-locale', 'fr') }}">
                            <img src="{{ asset('images/flags/fr.png') }}" alt="Français" height="20" class="mr-2">
                            Français
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('set-locale', 'de') }}">
                            <img src="{{ asset('images/flags/de.png') }}" alt="Deutsch" height="20" class="mr-2">
                            Deutsch
                        </a>
                    </div>
                </li>

                <!-- User Menu (if authenticated) -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" 
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Auth::user()->avatar ?? asset('images/default-avatar.png') }}" 
                                 alt="Avatar" class="rounded-circle" width="30" height="30" class="mr-2">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('home') }}">
                                <i class="fas fa-user mr-2"></i> Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('home') }}">
                                <i class="fas fa-cog mr-2"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item" style="cursor: pointer;">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                @else
                    <!-- Login/Register (if guest) -->
                    {{--  <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus mr-2"></i> Register
                        </a>
                    </li> --}}
                @endauth
            </ul>

        </div>
    </nav>
</header>
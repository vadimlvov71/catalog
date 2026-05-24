<!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper" style="/*width: 250px;*/ min-height: 100vh;">
            <div class="sidebar-heading border-bottom bg-dark text-white p-3">
                <h5 class="m-0">Menu</h5>
            </div>
            
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.index', $locale) }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-home mr-2"></i> Home
                </a>
                <!--<a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-chart-line mr-2"></i> Dashboard
                    fa-star-half-alt
                </a>-->
                <a href="{{ route('admin.category.index', $locale)}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-th mr-2"></i> Categories
                </a>
                <a href="{{ route('admin.item.index', $locale)}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-table mr-2"></i> Items
                </a>
                <a href="{{ route('admin.item.index', $locale)}}"class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-globe mr-2"></i> Languages
                </a>
                <a href="{{ route('admin.item.index', $locale)}}"class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-globe mr-2"></i> RU
                </a>
                <a href="{{ route('admin.item.index', $locale)}}"class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-globe mr-2"></i> EN
                </a>
                <a href="{{ route('admin.item.index', $locale)}}"class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-globe mr-2"></i> UA
                </a>
                <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-users mr-2"></i> Users
                </a>
                <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-cog mr-2"></i> Settings
                </a>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="list-group-item list-group-item-action bg-dark text-white" type="submit">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>

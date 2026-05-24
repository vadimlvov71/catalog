<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($breadcrumbs as $crumb)
            @if($crumb['url'])
                <li class="breadcrumb-item"><a href="{{ $crumb['url'] }}">{{ $crumb['title'] }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ $crumb['title'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>
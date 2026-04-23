
<h2>{{$sideBarData['title']}}</h2>

<div class="sidebar-sticky">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="#">Home</a>
        </li>
        @foreach ($categories as $category)
            <li class="nav-item">
                 <a href="{{ route('category', ['locale' => $locale, 'category' => $category->url]) }}">{{ $category->getLocalName($locale)}}</a>
            </li>
          
        @endforeach
        <!-- Add more categories as needed -->
    </ul>
</div>

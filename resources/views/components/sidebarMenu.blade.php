111<ol class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('home', ['locale' => $locale]) }}">Home</a>
    </li>
  @foreach($categories as $cat)
    <li class="nav-item">
      <a class="nav-link {{ (isset($category) && $category->id == $cat->id) ? 'active' : '' }}" 
         href="{{ route('category', ['locale' => $locale, 'category' => $cat->url]) }}">
        {{ $cat->getLocalName($locale)}}
      </a>
    </li>
  @endforeach
</ol>
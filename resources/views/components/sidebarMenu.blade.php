<ul class="nav flex-column">
  @foreach($categories as $cat)
    <li class="nav-item">
      <a class="nav-link {{ (isset($category) && $category->id == $cat->id) ? 'active' : '' }}" 
         href="{{ route('category', ['locale' => $locale, 'id' => $cat->id, 'category' => $category]) }}">
        {{ $cat->name }}
      </a>
    </li>
  @endforeach
</ul>
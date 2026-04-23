<aside class="sidebar">
    <div class="sidebar-card">
        <h5 class="card-title">
            <i class="fas fa-filter mr-2"></i> {{ trans('messages.filters') }}
        </h5>
        <form method="GET" action="{{ route('home') }}">
          
            <!-- Categories Filter -->
            <div class="filter-group mb-3">
                <h6>{{ trans('messages.categories') }}</h6>
                @if(isset($categories) && $categories->count())
                    @foreach($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="category[]" 
                                   value="{{ $category->id }}" id="cat_{{ $category->id }}"
                                   {{ in_array($category->id, request('category', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="cat_{{ $category->id }}">
                                {{ $category->{'name_' . $locale} ?? $category->name }}
                                <span class="text-muted">({{ $category->products_count }})</span>
                            </label>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted small">{{ trans('messages.no_categories') }}</p>
                @endif
            </div>

            <!-- Price Range Filter -->
            <div class="filter-group mb-3">
                <h6>{{ trans('messages.price_range') }}</h6>
                <div class="price-range">
                    <input type="range" class="form-control-range" id="priceMin" name="price_min" 
                           min="0" max="1000" value="{{ request('price_min', 0) }}"
                           oninput="document.getElementById('minPrice').textContent = this.value">
                    <input type="range" class="form-control-range" id="priceMax" name="price_max" 
                           min="0" max="1000" value="{{ request('price_max', 1000) }}"
                           oninput="document.getElementById('maxPrice').textContent = this.value">
                    <small class="text-muted">
                        $<span id="minPrice">{{ request('price_min', 0) }}</span> - 
                        $<span id="maxPrice">{{ request('price_max', 1000) }}</span>
                    </small>
                </div>
            </div>

            <!-- Rating Filter -->
            <div class="filter-group mb-3">
                <h6>{{ trans('messages.rating') }}</h6>
                @for($i = 5; $i >= 1; $i--)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rating" 
                               value="{{ $i }}" id="rating{{ $i }}"
                               {{ request('rating') == $i ? 'checked' : '' }}>
                        <label class="form-check-label" for="rating{{ $i }}">
                            @for($j = 1; $j <= 5; $j++)
                                <i class="fas fa-star {{ $j <= $i ? 'text-warning' : 'text-muted' }} fa-sm"></i>
                            @endfor
                            @if($i < 5)
                                <span class="text-muted small">& {{ trans('messages.up') }}</span>
                            @endif
                        </label>
                    </div>
                @endfor
            </div>

            <!-- In Stock Filter -->
            <div class="filter-group mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="in_stock" 
                           value="1" id="inStock"
                           {{ request('in_stock') ? 'checked' : '' }}>
                    <label class="form-check-label" for="inStock">
                        {{ trans('messages.in_stock_only') }}
                    </label>
                </div>
            </div>

            <!-- Sidebar Data (Custom Filters) -->
            @if(isset($sideBarData) && count($sideBarData) )
                @foreach($sideBarData as $filterGroup)
                    <div class="filter-group mb-3">
                        
                        @if($filterGroup)
                           {{ $filterGroup }}
                        @endif
                    </div>
                @endforeach
            @endif

            <!-- Submit Buttons -->
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-check mr-2"></i> {{ trans('messages.apply_filters') }}
            </button>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-block mt-2">
                <i class="fas fa-times mr-2"></i> {{ trans('messages.clear_filters') }}
            </a>
        </form>
    </div>
</aside>
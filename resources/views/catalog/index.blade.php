@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Fluid jumbotron</h1>
            <h1>{{ $title }}</h1>
            <p>{{ $description }}</p>
            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
        </div>
    </div>
    <main>
        <div class="row">
            @foreach ($categories as $category)
               
                {{--   @foreach ($category->getLocalName($locale) as $object) --}}
                <div class='col-sm-4 category-row' >
                    <div class="card category-block">
                        <div class="card-body">
                            <a href="{{ route('category', ['locale' => $locale, 'category' => $category->url]) }}">
                               {{-- {{ $category->name}}  --}} 
                                {{ $category->getLocalName($locale)}}
                                <img src="{{ Storage::url('uploads/' . $category->image) }}" 
                                alt="{{ $category->name }}"
                                class="img-fluid"
                                style="max-height: 400px; object-fit: cover;">
                            </a>
                            </div>
                    
                        {{--   @endforeach   --}}
                        @if ($category->items)
                            @foreach ($category->items as $items)
                                <div class='col-sm-3'>
                                    <div class='card'>
                                        <div class='title-item'>
                                            @foreach ($items->getLocalName($locale) as $item)
                                                777{{$item['name']}}
                                            @endforeach
                                        </div>
                                        <img src="{{url('/images')}}/{{$items->image}}" height="120" style="" alt="{{ $items->name }}">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
            
        </div>
        <div class="row">
            <div class="col-sm">
            One of three columns
            </div>
            <div class="col-sm">
            One of three columns
            </div>
            <div class="col-sm">
            One of three columns
            </div>
        </div>
    </main>
</div>

        

@endsection
@extends('layouts.appIndex')

@section('title', 'Page Title')

@section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid">
        <div class="lazy-bg" data-bg="{{ asset('images/potentional_clients1.jpg') }}">
      <!--<img class="lazy-bg" src="{{ asset('images/potentional_clients1.jpg') }}" alt="Описание">-->
            <div class="jumbotron-container">
                <div class="jumbotron-content1">
                    <h1 class="display-4">Fluid jumbotron</h1>
                    <h1>{{ $title }}</h1>
                    <p>{{ $description }}</p>
                    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="row">
            @foreach ($categories as $category)
               
                {{--   @foreach ($category->getLocalName($locale) as $object) --}}
                <div class='col-sm-4 category-row' >
                    <div class="card category-block shadow-sm p-3 mb-5 bg-white rounded">
                        <div class="card-body ">
                            <a href="{{ route('category', ['locale' => $locale, 'category' => $category->url]) }}">
                               {{-- {{ $category->name}}  --}} 
                                {{ $category->getLocalName($locale)}}
                                <img data-src="{{ asset(Storage::url('uploads/' . $category->image)) }}" 
                                alt="{{ $category->name }}"
                                class="lazy"
                                style="">
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

        img

@endsection
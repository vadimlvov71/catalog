<!-- resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', $pageTitle)
@include('layouts.include.header')
@section('sidebar')
@parent
@include('layouts.include.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
<p></p>
@endsection

@section('content')
<div class='row' style='padding:16px 0;background:#f4f4f7;'>
    @foreach ($categories as $category)
        @foreach ($category->getLocalName($locale)->get() as $object)
        <div class='col-sm-12 category-block'>
            <a href="{{ route('category', ['locale' => $locale, 'category' => $category->url]) }}">
                {{ $object->name}}
            </a>
           
        </div>
        @endforeach
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
@endsection
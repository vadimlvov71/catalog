<!-- resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', $pageTitle)
@include('layouts.include.header')
@section('sidebar')
@parent
   @include('admin.components.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
@endsection

@include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

@section('content')
<div class='col-sm-12 category-block'>
    {{$pageTitle}}
@foreach ($category as $cat)

    {{-- @foreach ($cat->getLocalName($locale)->get() as $cat_object)
        <li><a href="#">{{ $cat_object->name}}</a></li>
    @endforeach --}}
@endforeach         

</div>
<div class='row' style='padding:16px 0;background:#f4f4f7;'>
    @foreach ($items as $item)
        <div class='col-sm-4'>
            <div class='card'>
                <div class='title-item'>
                    <a href="{{ route('item', ['locale' => $locale, 'category' => $category->url,  'item_id' => $item->id, 'item' => $item->url]) }}">
                    @foreach ($item->getLocalName($locale) as $item1)
                        {{$item1['name']}}
                    @endforeach              
                    </a>
                </div>
                <img src="{{url('/images')}}/{{$item->image}}" height="120" style="" alt="{{ $item->name }}">
            </div>
        </div>    
    @endforeach
</div>
@endsection
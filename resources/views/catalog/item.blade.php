<!-- resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', $pageTitle)
@include('layouts.include.header')
@section('sidebar')
@parent
@include('layouts.include.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
<p></p>
@endsection

@include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
            
                <div class="card-body">
                    <h5 class="card-title">{{ $name }}</h5>
                    @foreach($item as $value)
                        <img src="{{url('/images')}}/{{$value->image}}" height="120" style="" alt="{{ $value->name }}">
                        <p class="card-text">{{ $description }}</p>
                        <h6 class="card-price">$29.99</h6>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
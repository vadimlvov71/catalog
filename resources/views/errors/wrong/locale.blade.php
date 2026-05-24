@extends('layouts.app')

@section('title', $pageTitle)

@section('content')

<div class="container mt-3">
  <h2>Error</h2>
    <div class="alert alert-danger">
        <strong>Error!</strong> You have used <a href="#" class="alert-link">a wronge language</a>.
    </div>
</div>
<div class='row' style='padding:16px 0;background:#f4f4f7;'>
    @foreach ($items as $item)
        <div class='col-sm-4'>
            <div class='card'>
                <div class='title-item'>
                    <a href="{{ route('set-locale', ['locale' => $item['url']]) }}">
                  
                        {{$item['name']}}
                             
                    </a>
                    {{$item['description']}}
                </div>
                <img src="{{url('/images')}}/{{$item['image']}}" height="120" style="" alt="{{ $item['name'] }}">
            </div>
        </div>    
    @endforeach
</div>
@stop
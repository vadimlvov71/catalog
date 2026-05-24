@extends('default')

@section('content')

<div class="container mt-3">
    @foreach ($categories as $category)
        <li>{{ $category->name }}</li>
    @endforeach
</div> 
<div class="container mt-3">
    @foreach ($items as $item)
        <li>{{ $item->name }}</li>
    @endforeach
</div> 
<div id="app">
        <hello-vue />
    </div>
    <!--<script src="{{ mix('js/app.js') }}"></script>-->
    @vite('resources/js/app.js')
@stop
@extends('layouts.admin')
@section('sidebar')
@parent
   @include('admin.components.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
@endsection

@section('content')
   
    <h1>{{ __('admin.create_category') }}</h1>
     @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @endif
    @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @include('admin.components.message', ['errors' => $errors])

    <form action="{{ route('admin.category.locale.store', [$locale, $categoryId]) }}" method="POST">
        @csrf
        <input type="text" name="category_id" value="{{ $categoryId }}">
        @include('admin.partials._formCatagoryLocale', ['item' => null])
        
         
        <button type="submit">Create</button>
    </form>
@endsection
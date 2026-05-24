@extends('layouts.admin')
@section('sidebar')
@parent
   @include('admin.components.sidebarMenu', ['sideBarData' => $sideBarData, 'locale' => $locale])
@endsection

@section('content')
    @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @include('admin.components.message', ['errors' => $errors])
    <h1>Create Item</h1>

    @error('name', 'description', 'price', 'category_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <form action="{{ route('item.store', $locale) }}" method="POST">
        @csrf
         {{-- Include the reusable form partial --}}
                    @include('admin.partials._form', ['item' => null])
        <!--<div>
            <label>Title</label>
            <input type="text" name="name" required value="{{ old('name') }}">
        </div>
        <div>
            <label>Url</label>
            <input name="url" required value="{{ old('url') }}">
        </div>
        <div>
            <label>Category_id</label>
                {!!Form::select('category_id', $select, null, ['placeholder'=>'Pick Program'])!!}
        </div>
        <div>
            <label>Status</label>
                {!!Form::select('status', $statuses, null, ['placeholder'=>'Pick Program'])!!}
        </div>
        -->
        <button type="submit">Create</button>
    </form>
@endsection
@extends('layouts.admin')
@section('sidebar')
@parent
   @include('admin.components.sidebarMenu', ['sideBarData' => $sideBarData, 'locale' => $locale])
@endsection

@section('content')
<div class="container mt-5">
        @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        @include('admin.components.message', ['errors' => $errors])
        <div class="row justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h1>Edit Post</h1>
                @error('name', 'description', 'category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            
                <form action="{{ route('admin.item.update', [$locale, $item->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div>
                        <label>Title</label>
                        <input type="text" name="name" value="{{ $item->name }}" >
                    </div>
                    <div>
                        <label>Url</label>
                        <input type="text" name="url" value="{{ $item->url }}" >
                        <!--<label>Content</label>
                        <textarea name="description" required>{{ $item->description }}</textarea>
                        -->
                    </div>
                    <div>
                        <label>Category_id</label>
                            {!!Form::select('category_id', $select, $item->category_id, ['placeholder'=>'Pick Category'])!!}
                    </div>
                    <div>
                        <label>Image</label>
                        <input type="file" name="file_upload">
                    </div>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

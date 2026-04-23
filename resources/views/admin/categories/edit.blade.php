@extends('layouts.admin')

@section('content')
<div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12">
            @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    <h1>Edit Category</h1>
    @error('name', 'description', 'category_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
        <table>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Actions</th>
                <th>updated</th>
            </tr>
                <form action="{{ route('admin.category.update', ['id' => $category->id, 'locale' => $locale]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div>
                        <label>Title</label>
                        <input type="text" name="name" value="{{ $category->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label>url</label>
                        <input type="text" name="url" required value="{{ $category->url }}">
                    </div>
                
                    <div>
                        <label>Image</label>
                        <input type="file" name="file_upload">
                    </div>
                    <button type="submit">Update</button>
                </form>
            </div>
             @foreach ($categoryLocalizes as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.item.show') }}">View</a>
                        <a href="{{ route('admin.category.local.edit', [$locale, $item->id]) }}">Edit</a>
                        <form action="" method="item" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        </div>
    </div>
@endsection

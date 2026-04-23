@extends('layouts.admin')
@section('sidebar')

@parent
   @include('admin.components.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
@endsection
<p></p>
@section('content')
<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-12">
            @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

    <h1>Edit Local Category</h1>

    @error('name', 'description', 'category_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
        <table>
            @foreach ($locales as $key => $local_name)
            <tr>
                <td><a href="{{ route('admin.language.set', $local_name)}}">{{ $key}}</a></td>
                <td>- </td>
            </tr>
            @endforeach
        </table> 
        <table>
            <tr>
            
                <th>Title</th>
                <th>Content</th>
                <th>Actions</th>
                <th>updated</th>
            </tr>
                <form action="{{ route('admin.category.local.update', ['locale' => $locale, 'id' => $category->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div>
                        <label>Title</label>
                        <input type="hidden" name="locale_id" value="{{ $categoryLocalize->id }}">
                        <input type="text" name="name" value="{{ $categoryLocalize->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label>description</label>
                        <textarea type="text" name="description" required>{{ $categoryLocalize->description }}</textarea>
                    </div>
                
                   
                    <button type="submit">Update</button>
                </form>
            </div>
             @foreach ($categoryLocalizes as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->updated_at->format('d-m-Y') }}</td>
                    <td>
                        
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

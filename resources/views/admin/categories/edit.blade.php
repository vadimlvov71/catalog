@extends('layouts.admin')
@section('sidebar')
@parent
   @include('admin.components.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
            @include('admin.components.message', ['errors' => $errors])
            <h1>Edit Category</h1>
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
                        <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" required value="{{ $category->url }}">
                    </div>
                    @error('url')
                        <div class="invalid-feedback d-block">
                            <i class="fa fa-times-circle mr-1"></i> {{ $message }}
                        </div>
                    @enderror

                    <div>
                        <label>status </label>
                        <select name="status" id="status{{ $category->id }}" class="form-control status-select" 
                            data-form-id="formId{{ $category->id }}">
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" 
                                {{ old('status', $category->status ?? '') == $status->value ? 'selected' : '' }}>
                                       
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('status')
                        <div class="invalid-feedback d-block">
                            <i class="fa fa-times-circle mr-1"></i> {{ $message }}
                        </div>
                    @enderror
                    
                    <button type="submit">Update</button>
                </form>

                <div>
                        <div>
                            <img src="{{ Storage::url('uploads/' . $category->image) }}" 
                             alt="{{ $category->name }}"
                             class="img-fluid"
                             style="max-height: 400px; object-fit: cover;">
                        </div>
                   
                        <label>Image</label>
                        @include('admin.components.upload', ['type' => 'category', 'id' => $category->id])
                    
                    
                </div>
            </div>
            </table>
            <table>
            <tr>
                <th>Id</th>
                <th>locale</th>
                <th>Title</th>

                <th>updated</th>
            </tr>
            <a href="{{ route('admin.category.locale.create', [$locale, $category->id]) }}">{{__('create_category_locale')}}</a>
             @foreach ($categoryLocalizes as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->locale }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->updated_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('admin.category.locale.edit', [$locale, $item->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </table>
        </div>
    </div>
@endsection

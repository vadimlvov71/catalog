@extends('layouts.admin')
@section('sidebar')

@parent
   @include('admin.components.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
@endsection
<p></p>
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
            @include('admin.components.message', ['errors' => $errors])
    <h1>Edit Local Category</h1>
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
                <th>Locale</th>
                <th>updated</th>
            </tr>
                <form action="{{ route('admin.category.locale.update', ['locale' => $locale, 'id' => $category->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="locale_id" value="{{ $categoryLocalize->id }}">
                    <input type="text" name="category_id" value="{{ $category->id }}">
                    @include('admin.partials._formCatagoryLocale', ['item' => $categoryLocalize])
                   
                    <button type="submit">Update</button>
                </form>
            </div>
             @foreach ($categoryLocalizes as $item)
                @if($item->id != $categoryLocalize->id)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->locale }}</td>
                        <td>{{ $item->updated_at->format('d-m-Y') }}</td>
                        <td>
                            
                            <a href="{{ route('admin.category.locale.edit', [$locale, $item->id]) }}">Edit</a>
                            <form action="" method="item" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
        </div>
    </div>
@endsection

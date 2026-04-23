@extends('layouts.admin')
@section('sidebar')
@parent
   @include('admin.components.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
@endsection
@section('content')
<div class="container row">
    <div class="col-md-3">
        <h3>Languages:</h3>
       
        <!--<a href="">Create Post</a>-->
        @if ($message = Session::get('success'))
            <div>{{ $message }}</div>
        @endif
        <table>
            @foreach ($locales as $key => $local_name)
            <tr>
                <td><a href="{{ route('admin.language.set', $local_name)}}">{{ $key}}</a></td>
                <td>- </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="col-md-9">
        <h3>items</h3>
    </div>
       
        <div class="col-md-4">
            <a href="{{ route('admin.item.index', $locale)}}">Items</a>
            <!--<a href="">Create Post</a>-->
            @if ($message = Session::get('success'))
                <div>{{ $message }}</div>
            @endif
            <table>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->getLocalNameOne($locale) }}</td>
                    <td>{{ $item->category_id }}</td>
                    <td>{{ $item->content }}</td>
                    <td>
                        <a href="">View</a>
                        <a href="">Edit</a>
                        <form action="" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.category.index', $locale)}}">Categories</a>
            <!--<a href="">Create Post</a>-->
            @if ($message = Session::get('success'))
                <div>{{ $message }}</div>
            @endif
            <table>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
                @foreach ($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->getLocalName($locale) }}</td>
                    <td>{{ $cat->content }}</td>
                    <td>
                        <a href="">View</a>
                        <a href="">Edit</a>
                        <form action="" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-4">
           
            <!--<a href="">Create Post</a>-->
            @if ($message = Session::get('success'))
                <div>{{ $message }}</div>
            @endif
            
        </div>
        <div class="col-md-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
</div>
@endsection

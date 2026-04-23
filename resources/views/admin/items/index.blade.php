@extends('layouts.admin')
@section('sidebar')
@parent
   @include('admin.components.sidebarMenu', ['sideBarData' => $sideBarData, 'locale' => $locale])
@endsection

@section('content')
    <h1>items</h1>
    @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    <a href="{{ route('admin.item.create') }}">Create Item</a>
    @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @endif
    <table>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Actions</th>
            <th>updated</th>
        </tr>
        @foreach ($items as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->category->name }}</td>
            <td>{{ $item->updated_at }}</td>
            <td>
                <a href="{{ route('admin.item.show') }}">View</a>
                <a href="{{ route('admin.item.edit', [$locale, $item->id]) }}">Edit</a>
                <form action="" method="item" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection

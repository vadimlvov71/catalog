@extends('layout')

@section('content')
    <h1>Languages</h1>
    <a href="{{ route('admin.language.create') }}">Create Language</a>
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
                <a href="{{ route('admin.item.edit', $item->id) }}">Edit</a>
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

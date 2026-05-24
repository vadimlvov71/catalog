@extends('layouts.admin')
@section('sidebar')
@parent
   @include('admin.components.sidebarMenu', ['sideBarData' => $sideBarData, 'locale' => $locale])
@endsection

@section('content')
    <h1>items</h1>
    @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    <a href="{{ route('admin.item.create', $locale) }}">Create Item</a>
    @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @endif
    <table>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Category</th>
            <th>updated</th>
            <th>Status</th>
            <th>-</th>
        </tr>
        @foreach ($items as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->category->name }}</td>
            <td>{{ $item->updated_at->format('d-m-Y') }}</td>
            <td>
                <form id="formId{{ $item->id }}" method="POST" action="{{ route('item.updateStatus', $locale) }}">
                    @csrf
                    @include('admin.components.selectStatus', ['statuses' => $statuses])
                </form>
            </td>
            <td>
                <a href="{{ route('admin.item.edit', [$locale, $item->id]) }}">Edit</a>
                <!--<form action="" method="item" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </table>
     @push('scripts')
        <script>
        console.log('status-select1');
            // Handle select change for multiple forms
            document.querySelectorAll('.status-select').forEach(select => {
            console.log('status-select');
                select.addEventListener('change', function() {
                    const formId = this.getAttribute('data-form-id');
                    const form = document.getElementById(formId);
                    
                    if (form) {
                        form.submit();
                    }
                });
            });
        </script>
    @endpush
@endsection

@extends('layouts.admin')
@section('sidebar')
@parent
   @include('admin.components.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
@endsection

@section('content')
    <h1>{{__('admin.categories')}}</h1>
    @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @include('admin.components.message', ['errors' => $errors])
    <a href="{{ route('admin.category.create', $locale) }}">{{__('create_category')}}</a>
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Url</th>
                <th>Status</th>
                <th>updated</th>
                <th>-</th>
            </tr>
            @foreach ($categories as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->url }}</td>
                <td>
                    @if ($item->image)
                        <div>
                            <img src="{{ Storage::url('uploads/' . $item->image) }}" 
                             alt="{{ $item->name }}"
                             class="img-fluid"
                             style="max-width: 90px; object-fit: cover;">
                        </div>
                    @else
                        <label>Image</label>
                       
                    @endif
                </td>
                <td>
                    <form id="formId{{ $item->id }}" method="POST" action="{{ route('category.updateStatus', $locale) }}">
                        @csrf
                        @include('admin.components.selectStatus', ['statuses' => $statuses])
                    </form>
                </td>
                <td>{{ $item->updated_at->format('d-m-Y') }}</td>
                <td>
                    
                    <a href="{{ route('admin.category.edit', [$locale, $item->id]) }}">Edit</a>
                    <form action="" method="item" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
                <td>{{$item->getLocalId($locale)}}</td>
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
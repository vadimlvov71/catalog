@extends('layouts.admin')
@section('sidebar')
@parent
   @include('admin.components.sidebarMenu', ['sideBarData' => $sideBarData, 'categories' => $categories, 'locale' => $locale])
@endsection
@section('content')
    <h1>{{__('admin.categories')}}</h1>
   
    @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @endif
    @include('layouts.include.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
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
                    <form id="formId{{ $item->id }}" method="POST" action="{{ route('category.updateStatus', $locale) }}">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $item->id }}">
                        <select name="status" id="status{{ $item->id }}" class="form-control status-select" 
                            data-form-id="formId{{ $item->id }}">
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" 
                                        {{ $item->status == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
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
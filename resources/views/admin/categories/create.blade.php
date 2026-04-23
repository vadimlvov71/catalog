@extends('layouts.admin')

@section('content')
   
    <h1>{{ __('admin.create_category') }}</h1>
    <form action="{{ route('admin.category.store') }}" method="POST">
        @csrf
        <div>
            <label>url</label>
            <input type="text" name="url" required>
        </div>
        <div>
            <label>locale</label>
            <input type="text" name="locale" value={{ $locale }}>
        </div>
        <div>
            <label>Name</label>
            @foreach ($languages as $language)
                <div>
                    <label>{{ $language->name }}</label>
                    <input type="text" name="name[{{strtolower($language->name)}}]" required>
                </div>
            @endforeach
        </div>
        <div>
        <label>Description</label>
            @foreach ($languages as $language)
            
            <div>
                <label>{{ $language->name }}</label>
                <textarea name="description[{{strtolower($language->name)}}]" required></textarea>
            </div>
            @endforeach
        </div>
         <div>
            <label>Status</label>
            <select name="status">
                @foreach ($status as $statusItem)
                    <div>
                        <option>{{ $statusItem->value }}</option>
                    </div>
                @endforeach
            </select> 
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
@extends('layout')

@section('content')
    <h1>Create Item</h1>
    <form action="{{ route('item.store') }}" method="POST">
        @csrf
        <div>
            <label>Title</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Description</label>
            <textarea name="description" required></textarea>
        </div>
        <div>
            <label>Category_id</label>
            
                {!!Form::select('category_id', $select, null, ['placeholder'=>'Pick Program'])!!}
        
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
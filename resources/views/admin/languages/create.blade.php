@extends('layout')

@section('content')
    <h1>Create Language</h1>
    <form action="{{ route('admin.language.store') }}" method="POST">
        @csrf
        <div>
            <label>Title</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Description</label>
            <textarea name="description" required></textarea>
        </div>
       
        <button type="submit">Create</button>
    </form>
@endsection
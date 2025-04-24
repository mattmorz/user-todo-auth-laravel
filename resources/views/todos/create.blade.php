@extends('layouts.app')

@section('content')
<h1>Create New Todo</h1>
<form method="POST" action="{{ route('todos.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control"  name="title" required>
        @error('title')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="icon" class="form-label">ToDo Icon(optional)</label>
        <input type="file" class="form-control" name="icon">
        @error('icon')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>

@endsection
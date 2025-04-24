{{-- resources/views/todos/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Edit Todo</h1>

  <form method="POST" action="{{ route('todos.update', $todo) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Title --}}
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input
        id="title"
        name="title"
        type="text"
        class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $todo->title) }}"
        required
      >
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Completed Checkbox --}}
    <div class="mb-3 form-check">
      <input type="hidden" name="completed" value="0">
      <input
        id="completed"
        name="completed"
        type="checkbox"
        class="form-check-input"
        value="1"
        {{ old('completed', $todo->completed) ? 'checked' : '' }}
      >
      <label for="completed" class="form-check-label">Completed</label>
    </div>

    {{-- Change Icon --}}
    <div class="mb-3">
      <label for="icon" class="form-label">Change Icon (optional)</label>
      <input
        id="icon"
        name="icon"
        type="file"
        class="form-control @error('icon') is-invalid @enderror"
      >
      @error('icon')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror

      @if($todo->icon_path)
        <div class="mt-2">
          <p>Current Icon:</p>
          <img
            src="{{ asset('storage/'.$todo->icon_path) }}"
            alt="Current Icon"
            style="max-height: 100px; object-fit: cover;"
          >
        </div>
      @endif
    </div>

    <button type="submit" class="btn btn-success">Update Todo</button>
    <a href="{{ route('todos.show', $todo) }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection

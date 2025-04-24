{{-- resources/views/todos/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
  <h1>{{ $todo->title }}</h1>

  @if($todo->icon_path)
    <div class="mb-3">
      <img
        src="{{ asset('storage/'.$todo->icon_path) }}"
        alt="Todo Icon"
        style="max-width: 150px; height: auto;"
      >
    </div>
  @endif

  <p>
    <strong>Status:</strong>
    @if($todo->completed)
      <span class="badge bg-success">Completed</span>
    @else
      <span class="badge bg-warning text-dark">Pending</span>
    @endif
  </p>

  <div class="mt-4">
    @auth
      @if($todo->user_id === auth()->id() || auth()->user()->is_admin)
        <a href="{{ route('todos.edit', $todo) }}" class="btn btn-primary">Edit</a>
      @endif
    @endauth

    <a href="{{ route('todos.index') }}" class="btn btn-secondary">Back to List</a>
  </div>
</div>
@endsection

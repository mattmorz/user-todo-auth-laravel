@extends('layouts.app')

@section('content')
    <h1>Todo List</h1>
    @auth
    <a href="{{ route('todos.create') }}" class="btn btn-primary mb-3">Add Todo</a>
    @endauth
    <ul class="list-group">
        @forelse($todos as $todo)
            <li class="list-group-item align-items-center">
                @if($todo['icon_path'])
                    <img src="{{ asset('storage/'.$todo['icon_path']) }}"
                        alt="icon"
                        style="width:50px;height:50px; margin-right:8px">
                @endif
                <a href="/todos/{{ $todo->id }}">
                    {{ $todo['title'] }}   
                </a>
               
                @if($todo->user_id===auth()->id())
                     <small>Assigned to You.  </small>
                @else
                    <small> Assigned to: {{ $todo->user->name }} </small>
                @endif

                @if($todo['completed'])
                    <span class="badge bg-success">Completed</span>
                @else
                    <span class="badge bg-warning">Pending</span>
                @endif
                @auth
               
                <span class="float-end align-items-center mt-2">
                    @if($todo->user_id===auth()->id())
                    <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-primary btn-sm" role="button"> Edit</a>
                    @endif
                    <form action="{{ route('todos.destroy',$todo->id)}}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Delete this?');">Delete</button>
                    </form>
                </span>
                
                @endauth
            </li>
        @empty
        <li>No todos yet.</li>
        @endforelse
    </ul>

@endsection


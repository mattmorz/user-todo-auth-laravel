@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">Edit Profile</h2>
  
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  
  <form method="POST" action="{{ route('profile.update') }}">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
      @error('name')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="password" class="form-label">New Password</label>
      <input type="password" name="password" id="password" class="form-control">
      @error('password')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Confirm Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>
@endsection
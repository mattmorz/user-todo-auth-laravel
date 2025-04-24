<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyApp</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" >
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">MyApp</a>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item float-left"><a class="nav-link" href="{{ route('todos.index') }}">ToDos</a></li>
          @guest
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
          @else
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name }}
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Role:{{ auth()->user()->is_admin ? 'Admin':'Worker' }}</a></li>
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Change Password</a></li>
              </ul>
            </div>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-link nav-link">Logout</button>
              </form>
            </li>
          @endguest
         
        </ul>
      </div>
    </nav>

    <div class="container">
      @if(session('status'))
        <x-alert type="success" :message="session('status')" class="mb-4"/>
      @endif
      @yield('content')
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" ></script>
  </body>
</html>
@vite(['resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('blog.index')}}">Home</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  See articles by category
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{route('categorised' ,1 )}}">Artistic</a></li>
                  <li><a class="dropdown-item" href="{{route('categorised' ,2)}}">Tehnic</a></li>
                  <li><a class="dropdown-item" href="{{route('categorised' ,3)}}">Science</a></li>
                  <li><a class="dropdown-item" href="{{route('categorised',4)}}">Moda</a></li>
                  <li><a class="dropdown-item" href="{{route('archieved')}}">Archieved articles</a></li>
                  <li><a class="dropdown-item" href="{{route('blog.subiect')}}">Subiect</a></li>
                </ul>
              </li>
              @if (Auth::check())
              <li class="nav-item">
                @if(Auth::user()->role == '1')
                <a class="nav-link" href="{{route('blog.create')}}">Create a new article</a>
                @endif
                <li class="nav-item">
                  @if(Auth::user()->role == '1')
                  <a class="nav-link" href="{{route('jurnalist')}}">Go to your articles</a>
                  @endif
              </li>
              <li class="nav-item dropdown">
                @if(Auth::user()->role == '2')
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Editor functions
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{route('blog.editor')}}">Go to editor page</a></li>
                  <li><a class="dropdown-item" href="{{route('unnapproved_journalists')}}">Unnaproved journalists page</a></li>
                </ul>
                @endif
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
              </li>
            </ul>
            @endif
            <ul class="navbar-nav ms-auto">
                <li class="nav-item ">
                    @if (Auth::check())
                  <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="nav-link" style="cursor: pointer;" :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                
                            Logout</a>
                        </form>

                    @else
                    <a class="nav-link ms-auto" href="{{route('login')}}">Login</a>
                    <li><a class="nav-link ms-auto" href="{{route('register')}}">Register</a></li>
                    @endif
                  </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container pt-5">
    @if (session()->has('message'))
    <div class="py-3 ">
        <div class="alert alert-danger">
            Warning
        </div>
        <div class="alert alert-danger">
            {{session()->get('message')}}
        </div>
    </div>
    @endif
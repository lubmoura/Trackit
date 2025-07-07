<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Trackit')</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">

 
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">


  <style>
    body {
      background-color: #121212;
      color: white;
      font-family: 'Russo One', sans-serif;
    }

    .btn-roxo {
      background-color: #6f42c1;
      color: white;
      border: none;
      padding: 0.375rem 0.75rem;
      border-radius: 0.25rem;
      transition: background-color 0.3s ease;
    }

    .btn-roxo:hover {
      background-color: #5936a8;
    }

    .navbar {
      padding: 1rem 2rem;
    }
  </style>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>


  <nav class="navbar navbar-expand-lg navbar-dark navbar-roxa bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">POPULAR</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTabs" aria-controls="navbarTabs" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTabs">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Games</a>
        <a class="nav-link {{ request()->routeIs('journal.index') ? 'active' : '' }}" href="{{ route('journal.index') }}">Synopses</a>
        
        @if (!auth()->user()->is_admin)
          <a class="nav-link {{ request()->routeIs('favorites.index') ? 'active' : '' }}" href="{{ route('favorites.index') }}">Favorites</a>
          <a class="nav-link {{ request()->routeIs('gamelist.index') ? 'active' : '' }}" href="{{ route('gamelist.index') }}">GameList</a>
        @endif
      </ul>


              <form method="POST" action="{{ route('logout') }}" class="me-2">
        @csrf
        <button type="submit" class="btn btn-roxo">Logout</button>
      </form>

      <a href="{{ route('profile.edit') }}" class="btn btn-outline-light">
        <i class="fa-solid fa-user"></i> Perfil
      </a>


      </div>
    </div>
  </nav>

  
  <div class="container-fluid py-4">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')

</body>
</html>

<link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark navbar-roxa bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">POPULAR</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTabs" aria-controls="navbarTabs" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTabs">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Games</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('journal.index') ? 'active' : '' }}" href="{{ route('journal.index') }}">Synopses</a>
        </li>
        @if (!auth()->user()->is_admin)
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('favorites.index') ? 'active' : '' }}" href="{{ route('favorites.index') }}">Favorites</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('gamelist.index') ? 'active' : '' }}" href="{{ route('gamelist.index') }}">GameList</a>
          </li>
        @endif
      </ul>

     
      <div class="dropdown me-3">
        <button class="btn btn-outline-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
          <li>
            <a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a>
          </li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item">Logout</button>
            </form>
          </li>
        </ul>
      </div>

      
      
    </div>
  </div>
</nav>

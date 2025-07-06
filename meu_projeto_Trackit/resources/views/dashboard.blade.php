@extends('layouts.simple')

@section('content')

<div class="bg-image"></div>
<div class="overlay"></div>

<div class="dashboard-page container py-4 text-white">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="dashboard-header">Game Dashboard</h2>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
    </form>
  </div>

  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
    @foreach ($games as $game)
      <div class="col">
        <div class="card card-dashboard h-100 border-0 shadow-sm">
          <a href="{{ route('reviews.game', ['game' => $game['title']]) }}">
            <img src="{{ $game['image'] }}" alt="{{ $game['title'] }}" class="card-img-top"
              onerror="this.onerror=null;this.src='https://via.placeholder.com/300x450?text=No+Image';">
          </a>
          <div class="card-body text-center">
            <h5 class="card-title">{{ $game['title'] }}</h5>

            @if (!empty($game['review']))
              <p class="card-review text-light mt-2">{{ $game['review'] }}</p>
              <div class="rating mt-1">
                @for ($i = 1; $i <= 5; $i++)
                  @if ($game['rating'] >= $i)
                    <span class="star">&#9733;</span>
                  @else
                    <span class="star empty">&#9733;</span>
                  @endif
                @endfor
              </div>
            @else
              <p class="card-review text-muted mt-2">Not reviewed yet.</p>
            @endif

            <div class="icon-row mt-3 d-flex justify-content-center gap-3">

              @if (auth()->user()->is_admin)
                <!-- Botões do admin -->
                <a href="{{ route('urls.edit', $game['id']) }}" class="btn btn-sm btn-admin-edit" title="Editar Jogo">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>

                <form method="POST" action="{{ route('urls.destroy', $game['id']) }}" onsubmit="return confirm('Tem certeza que deseja excluir este jogo?')" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-admin-delete" title="Excluir Jogo">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>

              @else
                <!-- Botões do usuário -->
                @php $isFavorited = in_array($game['title'], $favoritedTitles); @endphp
                @if ($isFavorited)
                  <form method="POST" action="{{ route('favorite.destroy', ['game_title' => $game['title']]) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link p-0 border-0 favorite-icon" title="Remover dos favoritos">
                      <i class="fa-solid fa-heart text-danger"></i>
                    </button>
                  </form>
                @else
                  <form method="POST" action="{{ route('favorite.store') }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="game_title" value="{{ $game['title'] }}">
                    <input type="hidden" name="image_url" value="{{ $game['image'] }}">
                    <button type="submit" class="btn btn-link p-0 border-0 favorite-icon" title="Favoritar">
                      <i class="fa-regular fa-heart text-light"></i>
                    </button>
                  </form>
                @endif

                @php $isInGameList = in_array($game['title'], $gameListTitles); @endphp
                @if ($isInGameList)
                  <form method="POST" action="{{ route('gamelist.destroy', ['game_title' => $game['title']]) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link p-0 border-0" title="Remover da GameList">
                      <i class="fa-solid fa-gamepad" style="color: #6f42c1;"></i>
                    </button>
                  </form>
                @else
                  <form method="POST" action="{{ route('gamelist.store') }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="game_title" value="{{ $game['title'] }}">
                    <input type="hidden" name="image_url" value="{{ $game['image'] }}">
                    <button type="submit" class="btn btn-link p-0 border-0" title="Adicionar à GameList">
                      <i class="fa-solid fa-gamepad" style="color: #6f42c1; opacity: 0.5;"></i>
                    </button>
                  </form>
                @endif
              @endif

            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="d-flex justify-content-center mt-4">
    {{ $paginatedUrls->links() }}
  </div>
</div>

<style>
  .card-dashboard {
    background-color: rgba(0, 0, 0, 0.7);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
  }

  .card-dashboard:hover {
    transform: translateY(-6px);
    box-shadow: 0 0 35px #6f42c1;
  }

  .card-img-top {
    max-height: 480px;
    padding: 0.8rem;
    object-fit: contain;
  }

  .card-dashboard .card-title {
    color: #fff;
    font-size: 1.25rem;
    font-weight: bold;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
  }

  .card-review {
    font-size: 0.95rem;
    color: #ccc;
    text-align: left;
    margin-top: 0.5rem;
  }

  .card-review.text-muted {
    color: #fff !important;
    text-align: center;
  }

  .rating {
    display: flex;
    justify-content: center;
    margin-top: 0.4rem;
     direction: ltr;
  }

  .rating .star {
    font-size: 1.3rem;
    color: gold;
    margin: 0 2px;
  }

  .rating .star.empty {
    color: #444;
  }

  .icon-row i {
    font-size: 1.5rem;
    transition: transform 0.2s ease;
  }

  .icon-row i:hover {
    transform: scale(1.2);
  }

  /* Botões admin*/
  .btn-admin-edit, .btn-admin-delete {
    width: 32px;
    height: 32px;
    padding: 0;
    border-radius: 8px;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .btn-admin-edit {
    background-color: #7a6fc1; 
    color: #eee;
  }
  .btn-admin-edit:hover {
    background-color: #6f5db3;
  }

  .btn-admin-delete {
    background-color: #c17a7a; 
    color: #eee;
  }
  .btn-admin-delete:hover {
    background-color: #ad6868;
  }
</style>

@endsection

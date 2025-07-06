@extends('layouts.simple')

@section('content')

<div class="bg-image"></div>
<div class="overlay"></div>

<div class="journal-page container py-4 text-white">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="favorites-header">Games Synopses:</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-roxo">← Return to Games</a>
  </div>

  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
    @foreach ($games as $game)
      <div class="col">
        <div class="card card-favorito h-100 border-0 shadow-sm">
          <img src="{{ $game['image'] }}" alt="{{ $game['title'] }}" class="card-img-top"
               onerror="this.onerror=null;this.src='https://via.placeholder.com/300x450?text=No+Image';">
          <div class="card-body text-center">
            <h5 class="card-title">{{ $game['title'] }}</h5>
            <p class="card-text text-white text-start">{{ $game['story'] }}</p>
          </div>
          <div class="card-footer bg-transparent border-0 text-end">

            @if (auth()->user()->is_admin)
              {{-- botoes do adm--}}
              @if (isset($game['id']))
                <a href="{{ route('journals.edit', $game['id']) }}" class="btn btn-sm btn-warning me-2" title="Editar História">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>

                <form method="POST" action="{{ route('journals.destroy', $game['id']) }}" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta história?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" title="Excluir História">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              @else
                <a href="{{ route('journals.create', ['title' => $game['title'], 'image' => $game['image']]) }}"
                   class="btn btn-sm btn-outline-light" title="Adicionar História">
                  <i class="fa-solid fa-plus"></i> Adicionar
                </a>
              @endif

            @else
              {{-- Botoes dos users--}}
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
    @endforeach
  </div>

  <div class="d-flex justify-content-center mt-4">
    {{ $games->links() }}
  </div>
</div>

@endsection

@extends('layouts.simple')

@section('content')

<div class="bg-image"></div>
<div class="overlay"></div>

<div class="journal-page container py-4 text-white">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="favorites-header">History of Games:</h2>
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
            @php $isInGameList = in_array($game['title'], $gameListTitles); @endphp
            @if ($isInGameList)
              <form method="POST" action="{{ route('gamelist.destroy', ['game_title' => $game['title']]) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link p-0 border-0" title="Remove from GameList">
                  <i class="fa-solid fa-gamepad" style="color: #6f42c1;"></i>
                </button>
              </form>
            @else
              <form method="POST" action="{{ route('gamelist.store') }}" class="d-inline">
                @csrf
                <input type="hidden" name="game_title" value="{{ $game['title'] }}">
                <input type="hidden" name="image_url" value="{{ $game['image'] }}">
                <button type="submit" class="btn btn-link p-0 border-0" title="Add to GameList">
                  <i class="fa-solid fa-gamepad" style="color: #6f42c1; opacity: 0.5;"></i>
                </button>
              </form>
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

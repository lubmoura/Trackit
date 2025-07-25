@extends('layouts.simple')

@section('content')

<div class="bg-image"></div>
<div class="overlay"></div>

<div class="favorites-page container py-4 text-white">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="favorites-header"> GameList:</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-roxo">← Return to Games</a>
  </div>

  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
    @foreach ($gamelist as $game)
      <div class="col">
        <div class="card card-favorito h-100 border-0 shadow-sm">
          <img src="{{ $game->image_url }}" class="card-img-top" alt="{{ $game->game_title }}">
          <div class="card-body text-center">
            <h5 class="card-title">{{ $game->game_title }}</h5>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection

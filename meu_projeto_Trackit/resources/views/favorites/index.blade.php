@extends('layouts.simple')

@section('content')


<div class="bg-image"></div>
<div class="overlay"></div>

<div class="favorites-page container py-4 text-white">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="favorites-header">My Favorites:</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-roxo">← Return to Games</a>
  </div>

  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
    @foreach ($favorites as $fav)
      <div class="col">
        <div class="card card-favorito h-100 border-0 shadow-sm">
          <img src="{{ $fav->image_url }}" class="card-img-top" alt="{{ $fav->game_title }}">
          <div class="card-body text-center">
            <h5 class="card-title">{{ $fav->game_title }}</h5>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection

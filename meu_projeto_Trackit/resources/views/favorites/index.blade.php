@extends('layouts.simple')

@section('content')
<div class="favorites-overlay"></div>

<div class="container favorites-page text-white">
  <div class="d-flex justify-content-between align-items-center">
    <h2 class="favorites-header">Meus Favoritos</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-voltar-dashboard">← Return to Games</a>
  </div>

  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
    @foreach ($favorites as $fav)
      <div class="col">
        <div class="card card-favorito h-100 border-0 shadow">
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

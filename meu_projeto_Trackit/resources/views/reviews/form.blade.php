@extends('layouts.simple')

@section('content')
  <div class="container py-4 text-white review-container">

    <a href="{{ route('dashboard') }}" class="btn voltar-btn mb-3">← Return to Games</a>

    <h2 class="mb-4">Review: {{ $gameData['title'] }}</h2>

    <img src="{{ $gameData['image'] }}" alt="Imagem do jogo {{ $gameData['title'] }}" class="img-jogo mb-4">

    <form method="POST" action="{{ route('reviews.store') }}">
    @csrf
    <input type="hidden" name="game_title" value="{{ $gameData['title'] }}">

    <div class="mb-3">
      <label class="form-label nota-label">Score⭐ </label>

  <div class="rating">
    @for ($i = 5; $i >= 1; $i--)
      <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
      <label for="star{{ $i }}" title="{{ $i }} estrela{{ $i > 1 ? 's' : '' }}">★</label>
    @endfor
  </div>
  
</div>

    <div class="mb-3">
      
      <label class="form-label comentario-label"> Comment 💬</label>

      <textarea class="form-control" name="comment" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn btn-roxo">Submit Review</button>
    </form>

    <hr class="my-4" />

    <h3 class="mb-3">Recent Review</h3>

    @if ($reviews->count())
    @foreach ($reviews as $review)
    <div class="p-3 rounded mb-3 review-box d-flex justify-content-between align-items-start">
    <div>
      <p class="text-warning mb-1 review-stars">
      @for ($i = 1; $i <= 5; $i++)
       <span class="{{ $i <= (int) $review->rating ? 'star-filled' : 'star-empty' }}">★</span>
    @endfor
      </p>

      <p>{{ $review->comment }}</p>
    </div>

    <div class="d-flex flex-column gap-2 ms-3">
      <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-pastel-blue btn-sm" title="Editar Review">
      <i class="bi bi-pencil-fill"></i>
      </a>

      <form action="{{ route('reviews.destroy', $review->id) }}" method="POST"
      onsubmit="return confirm('Tem certeza que deseja excluir esta review?');">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-pastel-red btn-sm" title="Excluir Review">
      <i class="bi bi-trash-fill"></i>
      </button>
      </form>
    </div>
    </div>
    @endforeach
    @else
    <p>Not review yet.</p>
    @endif

  </div>
@endsection
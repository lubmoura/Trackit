@extends('layouts.simple')

@section('title', 'Reviews - Trackit')

@section('content')
  <h2 class="mb-4">Escreva uma Review</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('reviews.store') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nome do Jogo</label>
      <input type="text" class="form-control" name="game_title" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Nota (1 a 5)</label>
      <input type="number" class="form-control" name="rating" min="1" max="5" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Comentário</label>
      <textarea class="form-control" name="comment" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-roxo">Enviar Review</button>
  </form>

  <hr class="my-4" />

  <h3>Reviews Recentes</h3>

  @if ($reviews->count())
    @foreach ($reviews as $review)
      <div class="bg-dark p-3 rounded mb-3">
        <strong>{{ $review->game_title }}</strong><br>
        <p class="text-warning mb-1">
          @for ($i = 0; $i < $review->rating; $i++) ★ @endfor
          @for ($i = $review->rating; $i < 5; $i++) ☆ @endfor
        </p>
        <p>{{ $review->comment }}</p>
      </div>
    @endforeach
  @else
    <p>Nenhuma review ainda.</p>
  @endif
@endsection

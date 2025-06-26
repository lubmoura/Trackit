@extends('layouts.simple')

@section('content')
<div class="container py-4 text-white review-container">

  <a href="{{ route('reviews.game', ['game' => $review->game_title]) }}" class="btn btn-outline-light mb-3">← Back</a>

  <h2 class="mb-4">Editar Review de {{ $review->game_title }}</h2>

  <form method="POST" action="{{ route('reviews.update', $review->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Nota (1 a 5)</label>
      <input type="number" name="rating" class="form-control" min="1" max="5" value="{{ old('rating', $review->rating) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Comentário</label>
      <textarea name="comment" rows="4" class="form-control" required>{{ old('comment', $review->comment) }}</textarea>
    </div>

    <button type="submit" class="btn btn-roxo">Atualizar Review</button>
  </form>

  <form method="POST" action="{{ route('reviews.destroy', $review->id) }}" class="mt-3">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta review?')">Excluir Review</button>
  </form>

</div>
@endsection

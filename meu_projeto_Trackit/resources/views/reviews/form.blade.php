@extends('layouts.simple')

@section('content')
<div class="container py-4 text-white review-container">

  <a href="{{ route('dashboard') }}" class="btn voltar-btn mb-3">← Voltar para o Dashboard</a>

  <h2 class="mb-4">Review de {{ $gameData['title'] }}</h2>

  <img src="{{ $gameData['image'] }}" alt="Imagem do jogo {{ $gameData['title'] }}" class="img-jogo mb-4">

  <form method="POST" action="{{ route('reviews.store') }}">
    @csrf
    <input type="hidden" name="game_title" value="{{ $gameData['title'] }}">

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

  <h3 class="mb-3">Reviews Recentes</h3>

  @if ($reviews->count())
    @foreach ($reviews as $review)
      <div class="p-3 rounded mb-3 review-box d-flex justify-content-between align-items-start">
        <div>
          <p class="text-warning mb-1">
            @for ($i = 0; $i < $review->rating; $i++) ★ @endfor
            @for ($i = $review->rating; $i < 5; $i++) ☆ @endfor
          </p>
          <p>{{ $review->comment }}</p>
        </div>

        <div class="d-flex flex-column gap-2 ms-3">
          <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-pastel-blue btn-sm" title="Editar Review">
            <i class="bi bi-pencil-fill"></i>
          </a>

          <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta review?');">
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
    <p>Nenhuma review ainda.</p>
  @endif

</div>
@endsection

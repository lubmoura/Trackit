@extends('layouts.simple')

@section('content')
<div class="container text-white py-4">
  <h2 class="mb-4">Adicionar História</h2>

  <form action="{{ route('journals.store') }}" method="POST">
    @csrf

    <input type="hidden" name="game_title" value="{{ $title }}">
    <input type="hidden" name="image_url" value="{{ $image }}">

    <div class="mb-3">
      <label for="gameTitle" class="form-label">Título do Jogo</label>
      <input type="text" class="form-control" id="gameTitle" value="{{ $title }}" disabled>
    </div>

    <div class="mb-3">
      <label for="story" class="form-label">História</label>
      <textarea class="form-control" name="story" id="story" rows="6" required></textarea>
    </div>

    <button type="submit" class="btn btn-success">Salvar História</button>
    <a href="{{ route('journal.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection

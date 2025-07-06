@extends('layouts.simple')

@section('content')
<div class="container journal-create text-white py-4">
  <a href="{{ route('journal.index') }}" class="btn btn-voltar mb-3">← Return</a>

  <h2 class="mb-4">Add Synopse</h2>

  <div class="card bg-dark p-4 rounded shadow">
    <form action="{{ route('journals.store') }}" method="POST">
      @csrf

      <input type="hidden" name="game_title" value="{{ $title }}">
      <input type="hidden" name="image_url" value="{{ $image }}">

      <div class="mb-3">
        <label for="gameTitle" class="form-label text-white">Game Title</label>
        <input type="text" class="form-control bg-dark text-white" id="gameTitle" value="{{ $title }}" disabled>
      </div>

      <div class="mb-3">
        <label for="story" class="form-label text-white">Synopse</label>
        <textarea class="form-control bg-dark text-white" name="story" id="story" rows="6" required></textarea>
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-pastel-roxo">Salve</button>
        <a href="{{ route('journal.index') }}" class="btn btn-outline-light">Cancel</a>
      </div>
    </form>
  </div>
</div>

<style>
  .journal-create {
    max-width: 700px;
    margin: 0 auto;
  }

  .btn-voltar {
    background-color: transparent;
    border: none;
    color: #bbb;
    font-weight: bold;
    font-size: 1rem;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .btn-voltar:hover {
    color: #fff;
  }

  .btn-pastel-roxo {
    background: linear-gradient(135deg, #c8b6ff 0%, #b8a1f2 100%);
    color: #2e1d47;
    font-weight: 600;
    border: none;
    border-radius: 12px;
    padding: 8px 18px;
    box-shadow: 0 3px 6px rgba(200, 182, 255, 0.5);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
  }

  .btn-pastel-roxo:hover {
    background: linear-gradient(135deg, #b8a1f2 0%, #c8b6ff 100%);
    color: #1c102d;
    box-shadow: 0 6px 12px rgba(200, 182, 255, 0.7);
  }
</style>
@endsection

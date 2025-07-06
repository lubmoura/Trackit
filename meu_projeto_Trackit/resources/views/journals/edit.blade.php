@extends('layouts.simple')

@section('content')
<div class="container py-4 text-white editar-sinopse-container">

  <a href="{{ route('journal.index') }}" class="btn btn-voltar mb-3">← Return</a>

  <h2 class="mb-4">Edit Synopses: {{ $journal->game_title }}</h2>

  <div class="card bg-dark p-4 rounded shadow editar-sinopse-card">
    <form method="POST" action="{{ route('journals.update', $journal->id) }}">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="game_title" class="form-label">Game Title</label>
        <input type="text" id="game_title" name="game_title" class="form-control bg-dark" value="{{ $journal->game_title }}" disabled>
      </div>

      <div class="mb-3">
        <label for="story" class="form-label">Synopses</label>
        <textarea name="story" id="story" rows="6" class="form-control bg-dark" required>{{ old('story', $journal->story) }}</textarea>
      </div>

      <button type="submit" class="btn btn-salvar">Save</button>
    </form>
  </div>
</div>

<style>
  .editar-sinopse-container {
    max-width: 600px;
  }

  .editar-sinopse-card {
    background-color: rgba(25, 25, 30, 0.9);
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(111, 66, 193, 0.7);
  }

  .form-label {
    font-weight: 600;
    font-family: 'Russo One', sans-serif;
    color: #ddd !important;
  }

  .form-control.bg-dark {
    background-color: #2a2a3a;
    border: 1px solid #6f42c1;
    color: white;
    font-family: 'Russo One', sans-serif;
    transition: border-color 0.3s ease;
  }

  .form-control.bg-dark:focus {
    background-color: #3b2a6d;
    border-color: #9e7fff;
    color: white;
    box-shadow: none;
  }

  .btn-salvar {
    background-color: #6f42c1;
    border: none;
    font-weight: 700;
    font-family: 'Russo One', sans-serif;
    padding: 0.5rem 1.2rem;
    transition: background-color 0.3s ease;
  }

  .btn-salvar:hover {
    background-color: #5936a8;
  }

  .btn-voltar {
    background-color: #6f42c1;
    color: white;
    border: none;
    padding: 0.375rem 0.75rem;
    border-radius: 0.25rem;
    transition: background-color 0.3s ease;
    font-family: 'Russo One', sans-serif;
    display: inline-block;
    text-decoration: none;
  }

  .btn-voltar:hover {
    background-color: #5936a8;
    color: white;
    text-decoration: none;
  }
</style>
@endsection

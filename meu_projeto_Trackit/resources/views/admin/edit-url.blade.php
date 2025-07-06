@extends('layouts.simple')

@section('content')
<div class="container editar-game-container text-white mt-4">

  <a href="{{ route('dashboard') }}" class="btn btn-voltar mb-3">← Voltar ao Dashboard</a>

  <h2 class="mb-4">Editar Imagem do Jogo</h2>

  <div class="card bg-dark p-4 rounded shadow editar-game-card">
    <form method="POST" action="{{ route('urls.update', $url->id) }}">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="url" class="form-label">URL da Imagem do Jogo</label>
        <input type="text" name="url" id="url" class="form-control bg-dark" value="{{ old('url', $url->url) }}" required>
      </div>

      <button type="submit" class="btn btn-salvar">Salvar</button>
      <a href="{{ route('dashboard') }}" class="btn btn-cancelar ms-2">Cancelar</a>
    </form>
  </div>
</div>

<style>
  .editar-game-container {
    max-width: 600px;
  }

  .editar-game-card {
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(111, 66, 193, 0.7);
  }

  .form-label {
    font-weight: 600;
    font-family: 'Russo One', sans-serif;
    color: #ddd !important;
  }

  .form-control.bg-dark {
    background-color: #3a2e2a;
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

  .btn-voltar,
  .btn-cancelar {
    background-color: #6f42c1;
    color: white;
    border: none;
    padding: 0.375rem 0.75rem;
    border-radius: 0.25rem;
    transition: background-color 0.3s ease;
    font-family: 'Russo One', sans-serif;
    text-decoration: none;
  }

  .btn-voltar:hover,
  .btn-cancelar:hover {
    background-color: #5936a8;
    color: white;
    text-decoration: none;
  }

  .btn-cancelar {
    display: inline-block;
  }
</style>
@endsection

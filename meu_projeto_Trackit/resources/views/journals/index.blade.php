@extends('layouts.simple')

@section('content')

<div class="bg-image"></div>
<div class="overlay"></div>

<div class="dashboard-page container py-4 text-white">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="dashboard-header">Games Synopses</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-roxo">← Return to Games</a>
  </div>

  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
    @foreach ($games as $game)
      <div class="col">
        <div class="card card-dashboard h-100 border-0 shadow-sm">
          <img src="{{ $game['image'] }}" alt="{{ $game['title'] }}" class="card-img-top"
               onerror="this.onerror=null;this.src='https://via.placeholder.com/300x450?text=No+Image';">
          <div class="card-body text-center">
            <h5 class="card-title">{{ $game['title'] }}</h5>
            <p class="card-text text-white text-start">{{ $game['story'] }}</p>
          </div>

          <div class="icon-row mt-3 d-flex justify-content-center gap-3 pb-3">

            @if (auth()->user()->is_admin)
    @if (isset($game['id']))
        <a href="{{ route('journals.edit', $game['id']) }}" class="btn btn-sm btn-admin-edit" title="Editar História">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>

        <form method="POST" action="{{ route('journals.destroy', $game['id']) }}" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta história?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-admin-delete" title="Excluir História">
                <i class="fa-solid fa-trash"></i>
            </button>
        </form>
    @else
        <a href="{{ route('journals.create', ['title' => $game['title'], 'image' => $game['image']]) }}"
           class="btn btn-sm btn-outline-light" title="Adicionar História">
            <i class="fa-solid fa-plus"></i> Add
        </a>
    @endif
@endif


          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="d-flex justify-content-center mt-4">
    {{ $games->links() }}
  </div>
</div>


<style>
  .card-dashboard {
    background-color: rgba(0, 0, 0, 0.7);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
  }

  .card-dashboard:hover {
    transform: translateY(-6px);
    box-shadow: 0 0 35px #6f42c1;
  }

  .card-img-top {
    max-height: 480px;
    padding: 0.8rem;
    object-fit: contain;
  }

  .card-title {
    color: #fff;
    font-size: 1.25rem;
    font-weight: bold;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
  }

  .card-text {
    font-size: 0.95rem;
    color: #ccc;
    text-align: left;
    margin-top: 0.5rem;
  }

  .icon-row i {
    font-size: 1.5rem;
    transition: transform 0.2s ease;
  }

  .icon-row i:hover {
    transform: scale(1.2);
  }

  /* Botões admin */
  .btn-admin-edit, .btn-admin-delete, .btn-admin-add {
    width: 32px;
    height: 32px;
    padding: 0;
    border-radius: 8px;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .btn-admin-edit {
    background-color: #7a6fc1;
    color: #eee;
  }

  .btn-admin-edit:hover {
    background-color: #6f5db3;
  }

  .btn-admin-delete {
    background-color: #c17a7a;
    color: #eee;
  }

  .btn-admin-delete:hover {
    background-color: #ad6868;
  }

  .btn-admin-add {
    background-color: #5cb85c;
    color: #fff;
  }

  .btn-admin-add:hover {
    background-color: #4cae4c;
  }
</style>

@endsection

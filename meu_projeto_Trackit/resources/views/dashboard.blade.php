<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>POPULAR</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      overflow-x: hidden;
    }

    .bg-image {
      background-image: url('https://images7.alphacoders.com/509/thumb-1920-509521.png');
      background-size: cover;
      background-position: center;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -2;
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: -1;
    }

    .navbar {
      padding: 1rem 2rem;
    }

    .card-img-top {
      height: 340px;
      object-fit: cover;
    }

    @media (min-width: 768px) {
      .card-img-top {
        height: 400px;
      }
    }
    .btn-roxo {
      background-color: #6f42c1;
      color: white;
      border: none;
      padding: 0.375rem 0.75rem;
      border-radius: 0.25rem;
      transition: background-color 0.3s ease;
    }

    .btn-roxo:hover {
      background-color: #5936a8;
      color: white;
    }
  </style>
</head>
<body>
  <div class="bg-image"></div>
  <div class="overlay"></div>

 
  <nav class="navbar navbar-expand-lg navbar-dark navbar-roxa">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">POPULAR</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTabs" aria-controls="navbarTabs" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTabs">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="#">Games</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Reviews</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Lists</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Journal</a></li>
        </ul>

      
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-roxo">Logout</button>
        </form>
      </div>
    </div>
  </nav>

  
  <div class="container-fluid py-4">
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
      @foreach ($games as $game)
        <div class="col">
          <a href="{{ route('reviews.game', ['game' => $game['title']]) }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow">
              <img src="{{ $game['image'] }}" class="card-img-top" alt="{{ $game['title'] }}"
                onerror="this.onerror=null;this.src='https://via.placeholder.com/300x450?text=Sem+Imagem';">
              <div class="card-body text-center">
                <h5 class="card-title">{{ $game['title'] }}</h5>

                @if (!empty($game['review']))
                  <div class="review-box mt-2">
                    {{ $game['review'] }}
                  </div>
                  <div class="rating mt-1">
                    @for ($i = 1; $i <= 5; $i++)
                      @if ($game['rating'] >= $i)
                        <span style="color: gold; font-size: 1.2rem;">&#9733;</span> 
                      @else
                        <span style="color: gray; font-size: 1.2rem;">&#9734;</span> 
                      @endif
                    @endfor
                  </div>
                @else
                  <div class="review-box mt-2 text-muted">
                    Sem review ainda
                  </div>
                @endif
              </div> 
            </div> 
          </a> 
        </div> 
      @endforeach
    </div> 
  </div> 

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

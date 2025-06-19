<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Trackit </title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      overflow-x: hidden;
    }

    nav.navbar {
      flex-shrink: 0;
      padding-top: 1rem;
      padding-bottom: 1rem;
      padding-left: 0;
      padding-right: 0;
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

    .main-content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: white;
      padding: 1rem;
      text-align: center;
    }

    .title-text {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
    }

    @media (min-width: 768px) {
      .title-text {
        font-size: 2.5rem;
      }
    }

    .btn-roxo {
      background-color: #6f42c1;
      color: white;
      border: none;
    }

    .btn-roxo:hover {
      background-color: #5936a8;
    }

    .btn-azul-outline {
      border: 1px solid #0d6efd;
      color: #0d6efd;
      background-color: transparent;
    }

    .btn-azul-outline:hover {
      background-color: #0d6efd;
      color: white;
    }
  </style>
</head>
<body>
  <div class="bg-image"></div>
  <div class="overlay"></div>

  <nav class="navbar navbar-expand-lg navbar-dark ps-3">
    <a class="navbar-brand" href="#">🎮 Trackit</a>
    <div class="ms-auto pe-3">
      <a href="/login" class="btn btn-azul-outline me-2">Sign in</a>
      <a href="/register" class="btn btn-roxo ps-3">Create an Account</a>
    </div>
  </nav>

  <div class="main-content">
    <h1 class="title-text">
     Keep track of the games you've played.<br />
     Save the ones you want to play.<br />
     Share them with friends.
    </h1>
  </div>
</body>
</html>

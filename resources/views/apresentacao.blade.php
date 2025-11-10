<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Sistema de controle De Doações Institucional</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="{{ asset('images/projeto.png') }}" sizes="186x186">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3 mb-0 ">
  <div class="container-fluid ps-4">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <span class="fw-light fs-4 text-dark shadow-sm p-3 mb-3 bg-body rounded hover-shadow">Sistema De Controle De Doações Institucional</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto text-center align-items-center">
        <li class="nav-item mx-2">
          <a class="btn btn-outline-success px-4" href="{{ route('login') }}">
            <i class="bi bi-box-arrow-in-right me-2"></i>Login
          </a>
        </li>
        <li class="nav-item mx-2">
          <a class="btn btn-success px-4" href="{{ route('cadastrar') }}">
            <i class="bi bi-person-plus me-2"></i>Cadastrar-se
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container-fluid d-flex justify-content-between align-items-start p-0 m-0" style="margin-top: -1px;">
  <div class="p-0 m-0">
    <img src="{{ asset('images/back.jpg') }}" alt="Imagem de fundo" class="img-fluid"
      style="width: 500px; height: 500px; display: block; margin: 0; padding: 0;">
  </div>

  <div class="d-flex align-items-center ms-7" style="min-height: 450px; margin-left: -100px; width: 600px">
    <div>
      <h1>Seja Bem-Vindo ao SCDI</h1>
      <p class="text-center">Conectando solidariedade e transformação.</p>
    </div>
  </div>

  <div class="p-0 m-0">
    <img src="{{ asset('images/projeto.png') }}" alt="Logo do projeto" class="img-fluid"
      style="width: 500px; height: 500px; display: block; margin: 0; padding: 0;">
  </div>
</div>

<figure>
  <blockquote class="blockquote">
    <p class="text-center">Conheça um pouco do nosso trabalho</p>
  </blockquote>
  <h6 class="text-center">O prazer de fazer o bem</h>
</figure>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">Texto do card 1.</p>
        </div>
      </div>
    </div>

    <div class="col-md-3 mb-4">
      <div class="card shadow-sm">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">Texto do card 2.</p>
        </div>
      </div>
    </div>

    <div class="col-md-3 mb-4">
      <div class="card shadow-sm">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">Texto do card 3.</p>
        </div>
      </div>
    </div>

    <div class="col-md-3 mb-4">
      <div class="card shadow-sm">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">Texto do card 4.</p>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Sistema de controle De Doações Institucional</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="{{ asset('images/projeto.png') }}" sizes="186x186">
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3 mb-0">
  <div class="container-fluid ps-4">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <img src="{{ asset('images/projeto.png') }}" alt="Logo" width="80" height="80" class="float-start me-4">
      <span class="fw-light fs-4 text-dark">Sistema De Controle De Doações Institucional</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item mx-2">
          <a class="nav-link active nav-hover" href="{{ url('/') }}">Início</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link nav-hover" href="{{ url('/sobre') }}">Sobre</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link nav-hover" href="{{ url('/servicos') }}">Serviços</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link nav-hover" href="{{ url('/contato') }}">Contato</a>
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


  <div class="p-0 m-0">
    <img src="{{ asset('images/projeto.png') }}" alt="Logo do projeto" class="img-fluid"
      style="width: 500px; height: 500px; display: block; margin: 0; padding: 0;">
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
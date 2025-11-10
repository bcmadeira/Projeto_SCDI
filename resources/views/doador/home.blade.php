<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Doador</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .card {
            border-radius: 12px;
            transition: .2s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0px 4px 18px rgba(0, 0, 0, 0.12);
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-light bg-white shadow-sm px-4">
        <span class="navbar-brand fw-bold text-success">
            <i class="bi bi-heart-fill"></i> Sistema de Doações
        </span>

        <form action="{{ route('logout.doador') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-box-arrow-right"></i> Sair
            </button>
        </form>
    </nav>

    <div class="container py-5">

        <h3 class="mb-4 text-dark">
            👋 Bem-vindo, <strong>{{ $doador->nome }}</strong>
        </h3>

        <h5 class="text-secondary mb-3">Campanhas disponíveis:</h5>

        <div class="row g-4">
            @foreach($campanhas as $campanha)
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="{{ $campanha->imagem ?? 'https://via.placeholder.com/600x300?text=Campanha' }}" class="card-img-top" alt="Imagem da campanha">
                    <div class="card-body">
                        <h5 class="card-title">{{ $campanha->titulo }}</h5>
                        <p class="text-muted small">{{ $campanha->instituicao->nome }}</p>
                        <p class="card-text">{{ Str::limit($campanha->descricao, 90) }}</p>

                        <a href="{{ route('doacoes.create', $campanha->id) }}" class="btn btn-success w-100">
                            <i class="bi bi-hand-index-thumb"></i> Doar Agora
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Campanha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="margin: 0; padding: 0; overflow-x: hidden;">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title">{{ $campanha->titulo }}</h3>
                <p class="card-text">{{ $campanha->descricao }}</p>

                <p><strong>Início:</strong> {{ \Carbon\Carbon::parse($campanha->data_inicio)->format('d/m/Y') }}</p>
                <p><strong>Término:</strong> {{ \Carbon\Carbon::parse($campanha->data_fim)->format('d/m/Y') }}</p>

                <a href="{{ route('campanhas.index') }}" class="btn btn-secondary mt-3">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de controle De Doações Institucional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/projeto.png') }}" sizes="186x186">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="margin: 0; padding: 0; overflow-x: hidden;">

    <div class="container mt-4">
        <h2 class="text-center mb-4">Campanhas</h2>

        <div class="row">
            @forelse($campanhas as $campanha)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $campanha->titulo }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($campanha->descricao, 100) }}</p>
                        <p><strong>Início:</strong> {{ \Carbon\Carbon::parse($campanha->data_inicio)->format('d/m/Y') }}</p>
                        <p><strong>Término:</strong> {{ \Carbon\Carbon::parse($campanha->data_fim)->format('d/m/Y') }}</p>

                        <a href="{{ route('campanhas.show', $campanha->id) }}" class="btn btn-primary mt-2">
                            <i class="bi bi-eye"></i> Detalhes
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-muted">Nenhuma campanha encontrada.</p>
            @endforelse
        </div>
    </div>
</body>
</html>

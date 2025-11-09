<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doar - {{ $campanha->titulo }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-center mb-4 text-success">
                    <i class="bi bi-heart-fill"></i> Doar para "{{ $campanha->titulo }}"
                </h3>

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('doacoes.store') }}" method="POST" class="row g-3">
                    @csrf

                    <div class="col-md-6">
                        <label class="form-label">Tipo de Doação</label>
                        <input type="text" name="tipo_doacao" class="form-control" placeholder="Ex: Financeira, Alimento, Roupas" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Valor (R$)</label>
                        <input type="number" step="0.01" name="valor" class="form-control" placeholder="Opcional">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Quantidade</label>
                        <input type="number" name="quantidade" class="form-control" placeholder="Ex: 10" min="1">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Informações adicionais (opcional)"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Instituição</label>
                        <select name="instituicao_id" class="form-select" required>
                            <option value="">Selecione...</option>
                            @foreach($instituicoes as $inst)
                            <option value="{{ $inst->id }}">{{ $inst->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Doador</label>
                        <select name="doador_id" class="form-select" required>
                            <option value="">Selecione...</option>
                            @foreach($doadores as $doador)
                            <option value="{{ $doador->id }}">{{ $doador->nome }} - {{ $doador->email }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-check2-circle"></i> Confirmar Doação
                        </button>
                        <a href="{{ route('campanhas.index') }}" class="btn btn-secondary px-4 ms-2">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

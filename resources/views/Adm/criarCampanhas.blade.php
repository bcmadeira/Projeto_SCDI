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

<body style="margin: 0; padding: 0; overflow-x: hidden;">

    <x-header />

    <div class="container mt-5">
        <h2 class="text-center mb-4">Criação de Campanha</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('campanhas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" placeholder="Digite o nome da campanha" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição da campanha (opcional)"></textarea>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Data de Início</label>
                    <input type="date" name="data_inicio" class="form-control" required>
                </div>
                <div class="col">
                    <label class="form-label">Data de Término</label>
                    <input type="date" name="data_fim" class="form-control" required>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Concluir Campanha</button>
            </div>
        </form>
    </div>

</body>


</html>

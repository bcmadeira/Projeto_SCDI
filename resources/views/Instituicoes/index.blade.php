<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Instituições</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<header>
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
                <ul class="navbar-nav ms-auto text-center">
                    <li class="nav-item mx-3">
                        <a class="nav-link active d-flex flex-column align-items-center" href="{{ url('/') }}">
                            <i class="bi bi-house fs-4 mb-1"></i>
                            <span>Início</span>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link d-flex flex-column align-items-center" href="{{ url('/sobre') }}">
                            <i class="bi bi-info-circle fs-4 mb-1"></i>
                            <span>Sobre</span>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link d-flex flex-column align-items-center" href="{{ url('/servicos') }}">
                            <i class="bi bi-gear fs-4 mb-1"></i>
                            <span>Serviços</span>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link d-flex flex-column align-items-center" href="{{ url('/contato') }}">
                            <i class="bi bi-envelope fs-4 mb-1"></i>
                            <span>Contato</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<body class="container mt-4">



    <h2>Lista de Instituições</h2>

    <a href="{{ route('instituicoes.create') }}" class="btn btn-primary mb-3">+ Cadastrar Instituição</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Cidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($instituicoes as $i)
            <tr>
                <td>{{ $i->nome }}</td>
                <td>{{ $i->cnpj }}</td>
                <td>{{ $i->cidade }}</td>
                <td>
                    <form action="{{ route('instituicoes.destroy', $i) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Nenhuma cadastrada</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Instituições</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

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

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Doador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 400px; border-radius: 20px;">
        <h4 class="text-center mb-3">Cadastrar Doador</h4>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('cadastro.doador') }}">
            @csrf

            <select name="tipo_doador" class="form-control mb-2" required>
                <option value="">Selecione o tipo de doador</option>
                <option value="pessoa_fisica">Pessoa Física</option>
                <option value="pessoa_juridica">Pessoa Jurídica</option>
            </select>

            <input name="nome" class="form-control mb-2" placeholder="Nome completo" required>
            <input name="cpf_cnpj" class="form-control mb-2" placeholder="CPF/CNPJ" required>
            <input name="telefone" class="form-control mb-2" placeholder="Telefone" required>

            <input name="endereco" class="form-control mb-2" placeholder="Endereço completo" required>
            <input name="cidade" class="form-control mb-2" placeholder="Cidade" required>

            <input type="email" name="email" class="form-control mb-2" placeholder="E-mail" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Senha" required>
            <input type="password" name="password_confirmation" class="form-control mb-2" placeholder="Confirmar senha" required>

            <button class="btn btn-success w-100">Cadastrar</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login.doador') }}">Já tem conta? Faça login</a>
        </div>
    </div>
</body>

</html>

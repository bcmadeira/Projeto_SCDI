<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Painel do Doador</title>
</head>

<body>
    <h1>Bem-vindo, {{ Auth::guard('doador')->user()->nome }}</h1>

    <form action="{{ route('doador.logout') }}" method="POST">
        @csrf
        <button type="submit">Sair</button>
    </form>

    <p>Aqui você poderá:</p>
    <ul>
        <li>Criar ou gerenciar suas instituições</li>
        <li>Fazer doações</li>
        <li>Ver relatórios</li>
    </ul>
</body>

</html>

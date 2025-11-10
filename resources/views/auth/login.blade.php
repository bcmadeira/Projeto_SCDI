<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Login do Doador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 400px; border-radius: 20px;">
        <h4 class="text-center mb-3">Login de Doador</h4>
        <form method="POST" action="{{ route('login.doador') }}">
            @csrf
            <input type="email" name="email" class="form-control mb-2" placeholder="E-mail" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Senha" required>
            <button class="btn btn-primary w-100">Entrar</button>
        </form>
        <div class="text-center mt-3">
            <a href="{{ route('cadastro.doador') }}">Ainda não tem conta? Cadastre-se</a>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Doações</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #a3d9ff, #e2f0ff);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 380px;
        }

        .login-card h3 {
            font-weight: bold;
            margin-bottom: 25px;
        }

        .btn-custom {
            background-color: #28a745;
            border: none;
        }

        .btn-custom:hover {
            background-color: #218838;
        }

        .text-small {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="login-card text-center">
        <h3>Entrar como Doador</h3>

        @if ($errors->any())
        <div class="alert alert-danger py-2">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li class="text-start">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login.doador.submit') }}">
            @csrf
            <div class="mb-3 text-start">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu e-mail" required>
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label">Senha</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Digite sua senha" required>
            </div>

            <button type="submit" class="btn btn-custom w-100 mb-3 text-white">Entrar</button>

            <p class="text-small">
                Não tem conta?
                <a href="{{ route('cadastro.doador') }}">Cadastre-se</a>
            </p>
        </form>
    </div>
</body>

</html>

<<<<<<< HEAD
@extends('layouts.app')

@section('title', 'Login - SCDI')

@section('content')
<div class="container-center">
    <div class="form-container">
        <!-- Logo e título do sistema -->
        <div class="logo-header">
            <img src="{{ asset('frontend/assets/images/logo sem a escrita.png') }}" alt="SCDI Logo" class="logo-img">
            <div class="logo-text">
                <div class="logo-title">SCDI</div>
                <div class="logo-subtitle">Sistema de Controle de Doação Institucional</div>
            </div>
        </div>

        <!-- Formulário de login -->
        <div class="form-title">Logar-se</div>
        <div class="form-subtitle">Utilize seu login e senha para acessar</div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form id="loginForm" action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>

            <button type="submit" class="btn-primary">ENTRAR</button>
        </form>

        <a href="{{ route('cadastrar') }}" class="btn-secondary">QUERO ME CADASTRAR</a>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('frontend/js/login.js') }}"></script>
@endpush
=======
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
>>>>>>> origin/main

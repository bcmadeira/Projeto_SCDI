@extends('layouts.app')

@section('title', 'Login - SCDI')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3 mb-0 ">
  <div class="container-fluid ps-4">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <span class="fw-light fs-4 text-dark shadow-sm p-3 mb-3 bg-body rounded hover-shadow">Sistema De Controle De Doações Institucional</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    </nav>

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

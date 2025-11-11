@extends('layouts.app')

@section('title', 'Cadastrar - SCDI')

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

        <!-- Mensagem de boas-vindas -->
        <div class="form-title">Bem-vindo</div>
        <div class="form-subtitle">O que você gostaria de fazer?</div>

        <!-- Opções de ação -->
        <a href="{{ route('doador.cadastro') }}" class="btn-primary" style="text-align: center; margin-bottom: 15px; display: block;">
            <i class="bi bi-heart-fill"></i> QUERO DOAR
        </a>

        <a href="{{ route('instituicao.cadastro') }}" class="btn-secondary" style="text-align: center; display: block;">
            <i class="bi bi-building"></i> QUERO CRIAR DOAÇÕES
        </a>

        <!-- Link para login -->
        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ route('login') }}" style="color: #666; text-decoration: none; font-size: 14px;">
                Já tenho uma conta? <strong>Fazer login</strong>
            </a>
        </div>
    </div>
</div>
@endsection

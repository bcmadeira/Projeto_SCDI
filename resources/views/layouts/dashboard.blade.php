<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard - SCDI')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Common CSS -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modals.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-scdi">
        <div class="container-fluid">
            <div class="logo-header" style="margin-bottom: 0;">
                <img src="{{ asset('frontend/assets/images/logo sem a escrita.png') }}" alt="SCDI Logo" class="logo-img">
                <div class="logo-text">
                    <div class="logo-title">SCDI</div>
                    <div class="logo-subtitle">Sistema de Controle de Doação Institucional</div>
                </div>
            </div>
            
            <div class="navbar-nav">
                <a href="{{ session('userType') === 'doador' ? route('dashboard.doador') : route('dashboard.instituicao') }}" class="navbar-brand-scdi" title="Início">
                    <i class="bi bi-house fs-5"></i>
                </a>
                <a href="{{ session('userType') === 'doador' ? route('doador.perfil') : route('instituicao.perfil') }}" class="navbar-brand-scdi" title="Perfil">
                    <i class="bi bi-person-circle fs-5"></i>
                </a>
                <a href="#" class="navbar-brand-scdi" title="Notificações" onclick="abrirNotificacoes(event)" id="btnNotificacoes">
                    <i class="bi bi-bell fs-5"></i>
                    <span class="notification-badge">3</span>
                </a>
                <a href="#" class="navbar-brand-scdi" title="Sobre" onclick="abrirSobre(event)">
                    <i class="bi bi-info-circle fs-5"></i>
                </a>
                <a href="#" class="navbar-brand-scdi" title="Configurações" onclick="abrirConfiguracoes(event)">
                    <i class="bi bi-gear fs-5"></i>
                </a>
                <a href="#" class="navbar-brand-scdi" title="Contato" onclick="abrirContato(event)">
                    <i class="bi bi-envelope fs-5"></i>
                </a>
                <a href="{{ url('/login') }}" class="navbar-brand-scdi" title="Sair" style="color: #dc3545;">
                    <i class="bi bi-box-arrow-right fs-5"></i>
                </a>
            </div>
        </div>
    </nav>

    @yield('content')
    
    <!-- Modals -->
    @include('components.modals')
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Modals JS -->
    <script src="{{ asset('frontend/js/modals.js') }}"></script>
    <script src="{{ asset('frontend/js/utils.js') }}"></script>
    
    @stack('scripts')
</body>
</html>

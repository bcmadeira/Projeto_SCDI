<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SCDI - Sistema de Campanhas de Doação e Instituições')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/header-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-style.css') }}">
    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Logo/Brand -->
            <a class="navbar-brand" href="#" onclick="return false;">
                <img src="{{ asset('images/logo.png') }}" alt="SCDI Logo" class="logo-img">
                SCDI
            </a>

            <!-- Mobile toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Main Navigation Menu -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" 
                           href="#" onclick="return false;">
                            <i class="fas fa-home me-1"></i>
                            Início
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="campanhasDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bullhorn me-1"></i>
                            Campanhas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="campanhasDropdown">
                            <li><a class="dropdown-item" href="#" onclick="return false;">
                                <i class="fas fa-list me-2"></i>Ver Campanhas</a></li>
                            <li><a class="dropdown-item" href="#" onclick="return false;">
                                <i class="fas fa-chart-line me-2"></i>Minhas Doações</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="doacoesDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-hand-holding-heart me-1"></i>
                            Doações
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="doacoesDropdown">
                            <li><a class="dropdown-item" href="#" onclick="return false;">
                                <i class="fas fa-heart me-2"></i>Fazer Doação</a></li>
                            <li><a class="dropdown-item" href="#" onclick="return false;">
                                <i class="fas fa-history me-2"></i>Histórico de Doações</a></li>
                            <li><a class="dropdown-item" href="#" onclick="return false;">
                                <i class="fas fa-trophy me-2"></i>Ranking Doadores</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('voluntarios*') ? 'active' : '' }}" 
                           href="#" onclick="return false;">
                            <i class="fas fa-hands-helping me-1"></i>
                            Ser Voluntário
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('instituicoes*') ? 'active' : '' }}" 
                           href="#" onclick="return false;">
                            <i class="fas fa-university me-1"></i>
                            Instituições
                        </a>
                    </li>
                </ul>

                <!-- Right side - User menu and notifications -->
                <ul class="navbar-nav ms-auto user-dropdown">
                    <!-- Notifications -->
                    <li class="nav-item dropdown">
                        <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge bg-danger notification-badge">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                            <li>
                                <h6 class="dropdown-header">Notificações</h6>
                            </li>
                            <li><a class="dropdown-item" href="#" onclick="return false;">
                                    <small class="text-muted">Nova doação recebida</small>
                                </a></li>
                            <li><a class="dropdown-item" href="#" onclick="return false;">
                                    <small class="text-muted">Campanha atingiu meta</small>
                                </a></li>
                            <li><a class="dropdown-item" href="#" onclick="return false;">
                                    <small class="text-muted">Novo voluntário cadastrado</small>
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-center" href="#" onclick="return false;">Ver todas</a></li>
                        </ul>
                    </li>

                    <!-- User Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i>
                            @auth
                            {{ Auth::user()->name ?? 'Usuário' }}
                            @else
                            Visitante
                            @endauth
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @auth
                            <li><a class="dropdown-item" href="#" onclick="return false;">
                                    <i class="fas fa-user me-2"></i>Meu Perfil</a></li>
                            <li><a class="dropdown-item" href="#" onclick="return false;">
                                    <i class="fas fa-cog me-2"></i>Configurações</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="#" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item" onclick="return false;">
                                        <i class="fas fa-sign-out-alt me-2"></i>Sair
                                    </button>
                                </form>
                            </li>
                            @else
                            <li><a class="dropdown-item" href="#" onclick="return false;">
                                    <i class="fas fa-sign-in-alt me-2"></i>Entrar</a></li>
                            <li><a class="dropdown-item" href="#" onclick="return false;">
                                    <i class="fas fa-user-plus me-2"></i>Cadastrar</a></li>
                            @endauth
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('Layout.Footer.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // CSRF Token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
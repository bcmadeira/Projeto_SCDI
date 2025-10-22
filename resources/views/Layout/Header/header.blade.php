<!DOCTYPE html><!DOCTYPE html>

<html lang="pt-BR"><html lang="pt-BR">



<head><head>

    <meta charset="UTF-8">    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SCDI - Sistema de Campanhas de Doação e Instituições')</title>    <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">    <title>@yield('title', 'SCDI - Sistema de Campanhas de Doação e Instituições')</title>

    <!-- Font Awesome -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">    <!-- Bootstrap CSS -->

    <!-- Custom CSS -->    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/header-style.css') }}" rel="stylesheet">    <!-- Font Awesome -->

    <link href="{{ asset('css/footer-style.css') }}" rel="stylesheet">    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->

    @yield('styles')    <link rel="stylesheet" href="{{ asset('css/header-style.css') }}">

</head>    <link rel="stylesheet" href="{{ asset('css/footer-style.css') }}">

    @stack('styles')

<body class="d-flex flex-column min-vh-100"></head>

    <!-- Header/Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top"><body class="d-flex flex-column min-vh-100">

        <div class="container">    <!-- Header/Navbar -->

            <a class="navbar-brand d-flex align-items-center" href="#" onclick="return false;">    <nav class="navbar navbar-expand-lg navbar-dark">

                <img src="{{ asset('images/logo.png') }}" alt="SCDI Logo" class="navbar-logo me-2">        <div class="container-fluid">

                <span class="brand-text">SCDI</span>            <!-- Logo/Brand -->

            </a>            <a class="navbar-brand" href="#" onclick="return false;">

                <img src="{{ asset('images/logo.png') }}" alt="SCDI Logo" class="logo-img">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">                SCDI

                <span class="navbar-toggler-icon"></span>            </a>

            </button>

            <!-- Mobile toggle button -->

            <div class="collapse navbar-collapse" id="navbarNav">            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"

                <ul class="navbar-nav me-auto">                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

                    <!-- Campanhas Dropdown -->                <span class="navbar-toggler-icon"></span>

                    <li class="nav-item dropdown">            </button>

                        <a class="nav-link dropdown-toggle" href="#" id="campanhasDropdown" role="button"

                            data-bs-toggle="dropdown" aria-expanded="false">            <!-- Navigation Links -->

                            <i class="fas fa-heart me-1"></i>Campanhas            <div class="collapse navbar-collapse" id="navbarNav">

                        </a>                <!-- Main Navigation Menu -->

                        <ul class="dropdown-menu" aria-labelledby="campanhasDropdown">                <ul class="navbar-nav me-auto">

                            <li><a class="dropdown-item" href="#" onclick="return false;">                    <li class="nav-item">

                                    <i class="fas fa-list me-2"></i>Ver Campanhas</a></li>                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" 

                            <li><a class="dropdown-item" href="#" onclick="return false;">                           href="#" onclick="return false;">

                                    <i class="fas fa-history me-2"></i>Minhas Doações</a></li>                            <i class="fas fa-home me-1"></i>

                        </ul>                            Início

                    </li>                        </a>

                    </li>

                    <!-- Doações Dropdown -->                    

                    <li class="nav-item dropdown">                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="doacoesDropdown" role="button"                        <a class="nav-link dropdown-toggle" href="#" id="campanhasDropdown" role="button" 

                            data-bs-toggle="dropdown" aria-expanded="false">                           data-bs-toggle="dropdown" aria-expanded="false">

                            <i class="fas fa-hand-holding-heart me-1"></i>Doações                            <i class="fas fa-bullhorn me-1"></i>

                        </a>                            Campanhas

                        <ul class="dropdown-menu" aria-labelledby="doacoesDropdown">                        </a>

                            <li><a class="dropdown-item" href="#" onclick="return false;">                        <ul class="dropdown-menu" aria-labelledby="campanhasDropdown">

                                    <i class="fas fa-donate me-2"></i>Fazer Doação</a></li>                            <li><a class="dropdown-item" href="#" onclick="return false;">

                            <li><a class="dropdown-item" href="#" onclick="return false;">                                <i class="fas fa-list me-2"></i>Ver Campanhas</a></li>

                                    <i class="fas fa-history me-2"></i>Histórico de Doações</a></li>                            <li><a class="dropdown-item" href="#" onclick="return false;">

                            <li><a class="dropdown-item" href="#" onclick="return false;">                                <i class="fas fa-chart-line me-2"></i>Minhas Doações</a></li>

                                    <i class="fas fa-trophy me-2"></i>Ranking Doadores</a></li>                        </ul>

                        </ul>                    </li>

                    </li>

                    <li class="nav-item dropdown">

                    <!-- Ser Voluntário -->                        <a class="nav-link dropdown-toggle" href="#" id="doacoesDropdown" role="button" 

                    <li class="nav-item">                           data-bs-toggle="dropdown" aria-expanded="false">

                        <a class="nav-link" href="#" onclick="return false;">                            <i class="fas fa-hand-holding-heart me-1"></i>

                            <i class="fas fa-hands-helping me-1"></i>Ser Voluntário                            Doações

                        </a>                        </a>

                    </li>                        <ul class="dropdown-menu" aria-labelledby="doacoesDropdown">

                            <li><a class="dropdown-item" href="#" onclick="return false;">

                    <!-- Instituições -->                                <i class="fas fa-heart me-2"></i>Fazer Doação</a></li>

                    <li class="nav-item">                            <li><a class="dropdown-item" href="#" onclick="return false;">

                        <a class="nav-link" href="#" onclick="return false;">                                <i class="fas fa-history me-2"></i>Histórico de Doações</a></li>

                            <i class="fas fa-building me-1"></i>Instituições                            <li><a class="dropdown-item" href="#" onclick="return false;">

                        </a>                                <i class="fas fa-trophy me-2"></i>Ranking Doadores</a></li>

                    </li>                        </ul>

                </ul>                    </li>



                <ul class="navbar-nav">                    <li class="nav-item">

                    <!-- Notificações -->                        <a class="nav-link {{ request()->is('voluntarios*') ? 'active' : '' }}" 

                    <li class="nav-item dropdown">                           href="#" onclick="return false;">

                        <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button"                            <i class="fas fa-hands-helping me-1"></i>

                            data-bs-toggle="dropdown" aria-expanded="false">                            Ser Voluntário

                            <i class="fas fa-bell"></i>                        </a>

                            <span class="badge bg-danger notification-badge">3</span>                    </li>

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">                    <li class="nav-item">

                            <li>                        <a class="nav-link {{ request()->is('instituicoes*') ? 'active' : '' }}" 

                                <h6 class="dropdown-header">Notificações</h6>                           href="#" onclick="return false;">

                            </li>                            <i class="fas fa-university me-1"></i>

                            <li><a class="dropdown-item" href="#" onclick="return false;">                            Instituições

                                    <small class="text-muted">Nova doação recebida</small>                        </a>

                                </a></li>                    </li>

                            <li><a class="dropdown-item" href="#" onclick="return false;">                </ul>

                                    <small class="text-muted">Campanha atingiu meta</small>

                                </a></li>                <!-- Right side - User menu and notifications -->

                            <li><a class="dropdown-item" href="#" onclick="return false;">                <ul class="navbar-nav ms-auto user-dropdown">

                                    <small class="text-muted">Novo voluntário cadastrado</small>                    <!-- Notifications -->

                                </a></li>                    <li class="nav-item dropdown">

                            <li>                        <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button"

                                <hr class="dropdown-divider">                            data-bs-toggle="dropdown" aria-expanded="false">

                            </li>                            <i class="fas fa-bell"></i>

                            <li><a class="dropdown-item text-center" href="#" onclick="return false;">Ver todas</a></li>                            <span class="badge bg-danger notification-badge">3</span>

                        </ul>                        </a>

                    </li>                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">

                            <li>

                    <!-- User Profile -->                                <h6 class="dropdown-header">Notificações</h6>

                    <li class="nav-item dropdown">                            </li>

                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"                            <li><a class="dropdown-item" href="#" onclick="return false;">

                            data-bs-toggle="dropdown" aria-expanded="false">                                    <small class="text-muted">Nova doação recebida</small>

                            <i class="fas fa-user-circle me-1"></i>                                </a></li>

                            @auth                            <li><a class="dropdown-item" href="#" onclick="return false;">

                            {{ Auth::user()->name ?? 'Usuário' }}                                    <small class="text-muted">Campanha atingiu meta</small>

                            @else                                </a></li>

                            Visitante                            <li><a class="dropdown-item" href="#" onclick="return false;">

                            @endauth                                    <small class="text-muted">Novo voluntário cadastrado</small>

                        </a>                                </a></li>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">                            <li>

                            @auth                                <hr class="dropdown-divider">

                            <li><a class="dropdown-item" href="#" onclick="return false;">                            </li>

                                    <i class="fas fa-user me-2"></i>Meu Perfil</a></li>                            <li><a class="dropdown-item text-center" href="#" onclick="return false;">Ver todas</a></li>

                            <li><a class="dropdown-item" href="#" onclick="return false;">                        </ul>

                                    <i class="fas fa-cog me-2"></i>Configurações</a></li>                    </li>

                            <li>

                                <hr class="dropdown-divider">                    <!-- User Profile -->

                            </li>                    <li class="nav-item dropdown">

                            <li>                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"

                                <form method="POST" action="#" class="d-inline">                            data-bs-toggle="dropdown" aria-expanded="false">

                                    @csrf                            <i class="fas fa-user-circle me-1"></i>

                                    <button type="submit" class="dropdown-item" onclick="return false;">                            @auth

                                        <i class="fas fa-sign-out-alt me-2"></i>Sair                            {{ Auth::user()->name ?? 'Usuário' }}

                                    </button>                            @else

                                </form>                            Visitante

                            </li>                            @endauth

                            @else                        </a>

                            <li><a class="dropdown-item" href="#" onclick="return false;">                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">

                                    <i class="fas fa-sign-in-alt me-2"></i>Entrar</a></li>                            @auth

                            <li><a class="dropdown-item" href="#" onclick="return false;">                            <li><a class="dropdown-item" href="#" onclick="return false;">

                                    <i class="fas fa-user-plus me-2"></i>Cadastrar</a></li>                                    <i class="fas fa-user me-2"></i>Meu Perfil</a></li>

                            @endauth                            <li><a class="dropdown-item" href="#" onclick="return false;">

                        </ul>                                    <i class="fas fa-cog me-2"></i>Configurações</a></li>

                    </li>                            <li>

                </ul>                                <hr class="dropdown-divider">

            </div>                            </li>

        </div>                            <li>

    </nav>                                <form method="POST" action="#" class="d-inline">

                                    @csrf

    <!-- Main Content -->                                    <button type="submit" class="dropdown-item" onclick="return false;">

    <main class="flex-grow-1">                                        <i class="fas fa-sign-out-alt me-2"></i>Sair

        @yield('content')                                    </button>

    </main>                                </form>

                            </li>

    <!-- Footer -->                            @else

    @include('Layout.Footer.footer')                            <li><a class="dropdown-item" href="#" onclick="return false;">

                                    <i class="fas fa-sign-in-alt me-2"></i>Entrar</a></li>

    <!-- Bootstrap JS -->                            <li><a class="dropdown-item" href="#" onclick="return false;">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>                                    <i class="fas fa-user-plus me-2"></i>Cadastrar</a></li>

    @yield('scripts')                            @endauth

</body>                        </ul>

                    </li>

</html>                </ul>
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
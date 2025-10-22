<header style="
        background: url('images/back.jpg') no-repeat center center;
        background-size: cover;
        width: 100%;
        height: auto;
        ">

        <nav class="navbar navbar-expand-lg navbar-light shadow-sm py-3 mb-0"
            style="background-color: rgba(255, 255, 255, 0.65); backdrop-filter: blur(3px);">
            <div class="container-fluid ps-4 pe-4">

                <!-- Logo e nome -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('images/projeto.png') }}" alt="Logo SCDI" style="height: 45px; margin-right: 10px;">
                    <span class="fw-bold fs-5 text-dark shadow-sm p-2 bg-body rounded">
                        SISTEMA DE CONTROLE DE DOAÇÕES INSTITUCIONAL
                    </span>
                </a>

                <!-- Botão responsivo -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto text-center">
                        <li class="nav-item mx-3">
                            <a class="nav-link active d-flex flex-column align-items-center" href="{{ url('/') }}">
                                <i class="bi bi-house fs-4 mb-1"></i>
                                <span>Início</span>
                            </a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link d-flex flex-column align-items-center" href="{{ url('/sobre') }}">
                                <i class="bi bi-info-circle fs-4 mb-1"></i>
                                <span>Sobre</span>
                            </a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link d-flex flex-column align-items-center" href="{{ url('/servicos') }}">
                                <i class="bi bi-gear fs-4 mb-1"></i>
                                <span>Serviços</span>
                            </a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link d-flex flex-column align-items-center" href="{{ url('/contato') }}">
                                <i class="bi bi-envelope fs-4 mb-1"></i>
                                <span>Contato</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

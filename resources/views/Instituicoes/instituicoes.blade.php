<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Criar sua Instituição </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="{{ asset('images/projeto.png') }}" sizes="186x186">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/instituicoes.css'])
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3 mb-0 ">
            <div class="container-fluid ps-4">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <span class="fw-light fs-4 text-dark shadow-sm p-3 mb-3 bg-body rounded hover-shadow">Sistema De Controle De Doações Institucional</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

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

    <main>
        <h2>Bem-vindo</h2>
        <p>Crie sua conta para receber doações</p>

        <form action="{{ route('instituicoes.store') }}" method="POST">
            @csrf
            <div class="row g-3 w-100">
                <!-- Coluna 1 -->
                <div class="col-md-4">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control mb-3" placeholder="Digite seu nome">

                    <label>Telefone</label>
                    <input type="text" name="telefone" class="form-control mb-3" placeholder="Digite seu telefone">

                    <label>Outro (Opcional)</label>
                    <input type="text" name="telefone2" class="form-control mb-3" placeholder="Outro contato">

                    <label>CPF</label>
                    <input type="text" name="cpf" class="form-control mb-3" placeholder="Digite seu CPF">

                    <label>Descrição</label>
                    <textarea class="form-control mb-3" name="descricao" rows="3" placeholder="Digite a descrição da sua instituição"></textarea>
                </div>

                <!-- Coluna 2 -->
                <div class="col-md-4">
                    <label>CNPJ</label>
                    <input type="text" name="cnpj" class="form-control mb-3" placeholder="Digite o CNPJ">

                    <label>Ramo</label>
                    <input type="text" name="ramo" class="form-control mb-3" placeholder="Digite o ramo">

                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-success">CADASTRAR</button>
                    </div>
                </div>

                <!-- Coluna 3 -->
                <div class="col-md-4">
                    <label>Localização</label>
                    <input type="text" name="cep" class="form-control mb-2" placeholder="Digite o CEP">
                    <input type="text" name="rua" class="form-control mb-2" placeholder="Digite a rua">
                    <input type="text" name="numero" class="form-control mb-2" placeholder="Digite o número">
                    <input type="text" name="cidade" class="form-control mb-2" placeholder="Digite a cidade">
                    <input type="text" name="complemento" class="form-control mb-3" placeholder="Digite o complemento (Opcional)">

                    <label>Email</label>
                    <input type="email" name="emailInstituicao" class="form-control" placeholder="Digite o email da instituição">
                </div>
            </div>
        </form>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.js"></script>
</body>

</html>

@extends('layouts.dashboard')

@section('title', 'Perfil da Instituição')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="bi bi-building me-2"></i>
                Perfil da Instituição
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>
                        Informações da Instituição
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Nome da Instituição</label>
                            <p class="form-control-plaintext">{{ $instituicao->nome }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <p class="form-control-plaintext">{{ $instituicao->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">CNPJ</label>
                            <p class="form-control-plaintext">{{ $instituicao->cnpj }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Telefone</label>
                            <p class="form-control-plaintext">{{ $instituicao->telefone }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tipo</label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-success">{{ ucfirst($instituicao->tipo) }}</span>
                            </p>
                        </div>
                    </div>

                    @if($instituicao->descricao)
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Descrição</label>
                            <p class="form-control-plaintext">{{ $instituicao->descricao }}</p>
                        </div>
                    </div>
                    @endif

                    <hr>

                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-geo-alt me-2"></i>
                        Endereço
                    </h6>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Rua</label>
                            <p class="form-control-plaintext">{{ $instituicao->endereco }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Cidade</label>
                            <p class="form-control-plaintext">{{ $instituicao->cidade }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Estado</label>
                            <p class="form-control-plaintext">{{ $instituicao->estado }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">CEP</label>
                            <p class="form-control-plaintext">{{ $instituicao->cep }}</p>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button class="btn btn-primary" onclick="habilitarEdicao()">
                            <i class="bi bi-pencil me-2"></i>
                            Editar Perfil
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">
                        <i class="bi bi-graph-up me-2"></i>
                        Estatísticas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Total Arrecadado</small>
                        <h4 class="text-success mb-0">R$ 0,00</h4>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Campanhas Ativas</small>
                        <h4 class="text-primary mb-0">0</h4>
                    </div>
                    <div>
                        <small class="text-muted">Total de Doadores</small>
                        <h4 class="text-info mb-0">0</h4>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0">
                        <i class="bi bi-shield-check me-2"></i>
                        Segurança
                    </h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-2">Altere sua senha para manter sua conta segura</p>
                    <button class="btn btn-warning btn-sm w-100" onclick="abrirModalSenha()">
                        <i class="bi bi-key me-2"></i>
                        Alterar Senha
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function habilitarEdicao() {
    alert('Funcionalidade de edição será implementada em breve!');
}

function abrirModalSenha() {
    alert('Funcionalidade de alteração de senha será implementada em breve!');
}
</script>
@endsection

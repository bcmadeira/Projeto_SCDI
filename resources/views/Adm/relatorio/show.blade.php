@extends('layouts.dashboard')

@section('title', 'Detalhes da Campanha - SCDI')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">
                        <i class="bi bi-eye"></i>
                        DETALHES DA CAMPANHA
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('adm.relatorios.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Cabeçalho da Campanha -->
                    <div class="row mb-4">
                        <div class="col-md-12 text-center">
                            <h4>SISTEMA DE CONTROLE DE DOAÇÕES INSTITUCIONAL</h4>
                            <h5>Projeto Ajude Cães > Relatório > Dashboard</h5>
                            <h3 class="text-primary">{{ $campanha->instituicao->nome }}</h3>
                        </div>
                    </div>

                    <!-- Informações da Campanha -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text">Data de Início</span>
                                    <span class="info-box-number">
                                        {{ \Carbon\Carbon::parse($campanha->data_inicio)->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text">Data de Término</span>
                                    <span class="info-box-number">
                                        {{ \Carbon\Carbon::parse($campanha->data_fim)->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text">Tempo de Ação</span>
                                    <span class="info-box-number">
                                        {{ $dadosRelatorio['dias_duracao'] }} Dias
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Responsáveis -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5><i class="fas fa-users"></i> Responsáveis</h5>
                            <div class="d-flex flex-wrap gap-3">
                                <span class="badge badge-primary p-2">Leo Barbosa</span>
                                <span class="badge badge-primary p-2">Bruno Cernach</span>
                                <span class="badge badge-primary p-2">Gustavo Pelissari</span>
                            </div>
                        </div>
                    </div>

                    <!-- Estatísticas -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5><i class="fas fa-paw"></i> Padrão de Cães</h5>
                            <p class="text-muted">Campanha para auxílio de cães em situação de vulnerabilidade</p>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="info-box bg-success text-white">
                                        <div class="info-box-content">
                                            <span class="info-box-text">Doadores</span>
                                            <span class="info-box-number">
                                                {{ $dadosRelatorio['quantidade_doadores'] }} Doadores
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="info-box
                                        {{ $campanha->data_fim < now() ? 'bg-secondary' : 'bg-warning' }} text-white">
                                        <div class="info-box-content">
                                            <span class="info-box-text">Status</span>
                                            <span class="info-box-number">
                                                {{ $campanha->data_fim < now() ? 'Finalizado' : 'Em Andamento' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Doações Individuais -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5><i class="fas fa-donate"></i> Doações Recebidas</h5>
                            <div class="row">
                                @foreach($campanha->doacoes as $doacao)
                                <div class="col-md-4 mb-3">
                                    <div class="card border-primary">
                                        <div class="card-body text-center">
                                            <h4 class="text-success">
                                                R$ {{ number_format($doacao->valor, 2, ',', '.') }}
                                            </h4>
                                            <p class="mb-1">
                                                <strong>Doador:</strong> {{ $doacao->doador->nome }}
                                            </p>
                                            <p class="mb-1 text-muted">
                                                <small>
                                                    Data: {{ \Carbon\Carbon::parse($doacao->data_doacao)->format('d/m/Y') }}
                                                </small>
                                            </p>
                                            <span class="badge badge-info">
                                                {{ $doacao->tipo_doacao }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Resumo Financeiro -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-chart-line"></i> Resumo Financeiro
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-md-4">
                                            <h3 class="text-success">
                                                R$ {{ number_format($dadosRelatorio['total_arrecadado'], 2, ',', '.') }}
                                            </h3>
                                            <p class="text-muted">Total Arrecadado</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="text-primary">
                                                {{ $dadosRelatorio['quantidade_doacoes'] }}
                                            </h3>
                                            <p class="text-muted">Total de Doações</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="text-info">
                                                R$ {{ number_format($dadosRelatorio['media_diaria'], 2, ',', '.') }}
                                            </h3>
                                            <p class="text-muted">Média Diária</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

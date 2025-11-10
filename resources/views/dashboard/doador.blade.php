@extends('layouts.dashboard')

@section('title', 'Dashboard Doador - SCDI')

@section('content')
<div class="main-container">
    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title">Bem-vindo, Doador!</h1>
            <p class="text-muted m-0">Acompanhe suas doações e descubra novas campanhas</p>
        </div>
        <div><span class="text-muted small">Última atualização: </span><strong id="ultimaAtualizacao"></strong></div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-heart-fill"></i></div>
            <div class="stat-number">{{ $totalDoacoes ?? '15' }}</div>
            <div class="stat-label">Doações Realizadas</div>
            <div class="stat-change positive">+3 este mês</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue"><i class="bi bi-flag-fill"></i></div>
            <div class="stat-number">{{ $campanhasApoiadas ?? '8' }}</div>
            <div class="stat-label">Campanhas Apoiadas</div>
            <div class="stat-change positive">+2 este mês</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange"><i class="bi bi-currency-dollar"></i></div>
            <div class="stat-number">{{ $totalDoado ?? 'R$ 1.5k' }}</div>
            <div class="stat-label">Total Doado</div>
            <div class="stat-change positive">+R$ 450 este mês</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple"><i class="bi bi-award-fill"></i></div>
            <div class="stat-number">{{ $instituicoesAjudadas ?? '12' }}</div>
            <div class="stat-label">Instituições Ajudadas</div>
            <div class="stat-change positive">+1 nova</div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="recent-activities">
                <h3 class="chart-title"><i class="bi bi-star-fill"></i> Campanhas em Destaque</h3>
                <div class="row g-3">
                    @forelse($campanhasDestaque ?? [] as $campanha)
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">{{ $campanha->titulo }}</h5>
                                    <span class="badge bg-success">Ativa</span>
                                </div>
                                <p class="card-text text-muted small">{{ $campanha->instituicao->nome ?? 'Instituição' }} - {{ $campanha->descricao }}</p>
                                <div class="progress mb-2" style="height: 8px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">75% da meta atingida</small>
                                    <a href="{{ route('campanhas.show', $campanha->id) }}" class="btn btn-sm btn-success">Doar Agora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">Natal Solidário 2024</h5>
                                    <span class="badge bg-success">Ativa</span>
                                </div>
                                <p class="card-text text-muted small">ONG Esperança - Arrecadação de brinquedos para crianças</p>
                                <div class="progress mb-2" style="height: 8px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">75% da meta atingida</small>
                                    <a href="{{ route('campanhas.index') }}" class="btn btn-sm btn-success">Doar Agora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">Alimentação Emergencial</h5>
                                    <span class="badge bg-success">Ativa</span>
                                </div>
                                <p class="card-text text-muted small">Lar dos Idosos - Cestas básicas para famílias necessitadas</p>
                                <div class="progress mb-2" style="height: 8px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">60% da meta atingida</small>
                                    <a href="{{ route('campanhas.index') }}" class="btn btn-sm btn-success">Doar Agora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="recent-activities">
                <h3 class="chart-title"><i class="bi bi-clock-history"></i> Últimas Doações</h3>
                @forelse($ultimasDoacoes ?? [] as $doacao)
                <div class="activity-item">
                    <div class="activity-icon bg-success"><i class="bi bi-check"></i></div>
                    <div class="activity-content">
                        <div class="activity-title">R$ {{ number_format($doacao->valor, 2, ',', '.') }}</div>
                        <div class="activity-time">{{ $doacao->campanha->titulo ?? 'Campanha' }} - {{ $doacao->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @empty
                <div class="activity-item">
                    <div class="activity-icon bg-success"><i class="bi bi-check"></i></div>
                    <div class="activity-content">
                        <div class="activity-title">R$ 250,00</div>
                        <div class="activity-time">Natal Solidário - Ontem</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon bg-info"><i class="bi bi-check"></i></div>
                    <div class="activity-content">
                        <div class="activity-title">R$ 100,00</div>
                        <div class="activity-time">Agasalho do Bem - 2 dias atrás</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon bg-warning"><i class="bi bi-check"></i></div>
                    <div class="activity-content">
                        <div class="activity-title">R$ 50,00</div>
                        <div class="activity-time">Medicamentos - 5 dias atrás</div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="recent-activities">
        <h3 class="chart-title"><i class="bi bi-lightning"></i> Ações Rápidas</h3>
        <div class="quick-actions">
            <a href="{{ route('campanhas.index') }}" class="quick-action">
                <i class="bi bi-search"></i>
                <div class="quick-action-title">Buscar Campanhas</div>
                <div class="quick-action-desc">Encontre causas para apoiar</div>
            </a>
            <a href="{{ route('doador.minhas-doacoes') }}" class="quick-action">
                <i class="bi bi-list-check"></i>
                <div class="quick-action-title">Minhas Doações</div>
                <div class="quick-action-desc">Histórico completo</div>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('frontend/js/dashboard.js') }}"></script>
<script>
    document.getElementById('ultimaAtualizacao').textContent = new Date().toLocaleString('pt-BR', {
        day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit'
    });

    function abrirPerfil(event) {
        event.preventDefault();
        alert('Funcionalidade de perfil em desenvolvimento!');
    }
</script>
@endpush

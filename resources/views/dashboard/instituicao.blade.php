@extends('layouts.dashboard')

@section('title', 'Dashboard - SCDI')

@section('content')
<div class="main-container">
    <!-- Cabeçalho do Dashboard -->
    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title">Dashboard da Campanha</h1>
            <p style="color: #666; margin: 0;">Visão geral das suas atividades e estatísticas</p>
        </div>
        <div>
            <span style="color: #666; font-size: 14px;">Última atualização: </span>
            <span style="font-weight: 600;" id="ultimaAtualizacao"></span>
        </div>
    </div>

    <!-- Estatísticas Principais -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-heart-fill"></i>
            </div>
            <div class="stat-number" id="totalDoacoes">{{ $totalDoacoes }}</div>
            <div class="stat-label">Total de Doações</div>
            <div class="stat-change positive">+12% este mês</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-number" id="totalDoadores">{{ $totalDoadores }}</div>
            <div class="stat-label">Doadores Ativos</div>
            <div class="stat-change positive">+8% este mês</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="bi bi-flag-fill"></i>
            </div>
            <div class="stat-number" id="campanhasAtivas">{{ $campanhasAtivas }}</div>
            <div class="stat-label">Campanhas Ativas</div>
            <div class="stat-change positive">+3 novas</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="stat-number" id="valorArrecadado">{{ $valorArrecadado }}</div>
            <div class="stat-label">Valor Arrecadado</div>
            <div class="stat-change positive">+22% este mês</div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="charts-grid">
        <div class="chart-container">
            <h3 class="chart-title">
                <i class="bi bi-graph-up"></i>
                Projetos de Obras
            </h3>
            <canvas id="campanhasChart" width="400" height="200"></canvas>
        </div>

        <div class="chart-container">
            <h3 class="chart-title">
                <i class="bi bi-pie-chart"></i>
                Distribuição por Categoria
            </h3>
            <canvas id="categoriasChart" width="300" height="200"></canvas>
        </div>
    </div>

    <!-- Atividades Recentes e Ações Rápidas -->
    <div class="charts-grid">
        <div class="recent-activities">
            <h3 class="chart-title">
                <i class="bi bi-clock-history"></i>
                Atividades Recentes
            </h3>

            @if($atividadesRecentes->count() > 0)
                @foreach($atividadesRecentes as $doacao)
                <div class="activity-item">
                    <div class="activity-icon"
                         style="background: {{
                            ($doacao->tipo_doacao == 'Dinheiro') ? '#28a745' :
                            (($doacao->tipo_doacao == 'Alimentos') ? '#ffc107' :
                            (($doacao->tipo_doacao == 'Roupas') ? '#007bff' :
                            (($doacao->tipo_doacao == 'Medicamentos') ? '#17a2b8' : '#6c757d')))
                        }};">
                        <i class="bi {{
                            ($doacao->tipo_doacao == 'Dinheiro') ? 'bi-currency-dollar' :
                            (($doacao->tipo_doacao == 'Alimentos') ? 'bi-basket' :
                            (($doacao->tipo_doacao == 'Roupas') ? 'bi-bag' :
                            (($doacao->tipo_doacao == 'Medicamentos') ? 'bi-heart-pulse' : 'bi-gift')))
                        }}"></i>
                    </div>

                    <div class="activity-content">
                        <div class="activity-title">{{ $doacao->tipo_doacao }} - {{ $doacao->doador->nome ?? 'Anônimo' }}</div>
                        <div class="activity-time">
                            @if($doacao->valor)
                                R$ {{ number_format($doacao->valor, 2, ',', '.') }}
                            @endif
                            @if($doacao->quantidade)
                                - {{ $doacao->quantidade }} unidades
                            @endif
                            - {{ $doacao->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="activity-item">
                    <div class="activity-icon" style="background: #6c757d;">
                        <i class="bi bi-info-circle"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Nenhuma atividade recente</div>
                        <div class="activity-time">Aguardando novas doações</div>
                    </div>
                </div>
            @endif
        </div>

        <div class="recent-activities">
            <h3 class="chart-title">
                <i class="bi bi-lightning"></i>
                Ações Rápidas
            </h3>

            <div class="quick-actions">
                <a href="{{ route('campanhas.create') }}" class="quick-action">
                    <i class="bi bi-plus-circle"></i>
                    <div class="quick-action-title">Nova Campanha</div>
                    <div class="quick-action-desc">Criar uma nova campanha</div>
                </a>

                <a href="{{ route('campanhas.minhas') }}" class="quick-action">
                    <i class="bi bi-list-ul"></i>
                    <div class="quick-action-title">Minhas Campanhas</div>
                    <div class="quick-action-desc">Gerenciar campanhas</div>
                </a>

                <a href="{{ route('adm.relatorios.index') }}" class="quick-action">
                    <i class="bi bi-graph-up"></i>
                    <div class="quick-action-title">Relatórios</div>
                    <div class="quick-action-desc">Ver estatísticas</div>
                </a>

                <a href="#" class="quick-action" onclick="abrirConfiguracoes(event)">
                    <i class="bi bi-gear"></i>
                    <div class="quick-action-title">Configurações</div>
                    <div class="quick-action-desc">Ajustar preferências</div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- Carrega o Chart.js primeiro --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Dados do backend para os gráficos --}}
    <script>
        window.dadosCategorias = @json(array('labels' => $distribuicaoCategorias->pluck('tipo_doacao')->toArray(), 'valores' => $distribuicaoCategorias->pluck('total')->toArray()));
        window.dadosMensais = @json(array('labels' => $mesesLabels, 'valores' => $dadosMensais));
    </script>
    <script src="{{ asset('js/dashboard-data.js') }}"></script>
    <script src="{{ asset('frontend/js/dashboard.js') }}"></script>
@endpush

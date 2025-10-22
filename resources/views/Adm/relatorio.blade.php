@extends('layouts.app')

@section('content')
<div class="container my-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Sistema de Controle de Doações Institucional</h4>
        <span>
            {{ $campanhas->instituicoes->nome ?? '{Instituição Nome}' }}
        </span>
    </div>

    <h5>Projeto: {{ $campanhas->titulo }}</h5>
    <p class="text-muted">Relatório › Dashboard</p>

    <div class="row">
        <!-- Coluna Esquerda -->
        <div class="col-md-3">
            <div class="mb-3">
                <label>Data de Início</label>
                <input type="text" class="form-control"
                    value="{{ \Carbon\Carbon::parse($campanhas->data_inicio)->format('d/m/Y') }}" readonly>
            </div>

            <div class="mb-3">
                <label>Data de Término</label>
                <input type="text" class="form-control"
                    value="{{ \Carbon\Carbon::parse($campanhas->data_fim)->format('d/m/Y') }}" readonly>
            </div>

            <div class="mb-3">
                <label>Tempo de Ação</label>
                <input type="text" class="form-control"
                    value="{{ $tempoAcao }} dias" readonly>
            </div>
        </div>

        <!-- Gráfico Central -->
        <div class="col-md-6 text-center">
            <h5>Dashboard da Campanha</h5>
            <canvas id="graficoDoacoes" style="max-height: 300px;"></canvas>
            <p class="mt-3"><strong>{{ $campanhas->titulo }}</strong></p>
        </div>

        <!-- Coluna Direita -->
        <div class="col-md-3">
            <div class="mb-3">
                <label>Total de Doadores</label>
                <input type="text" class="form-control" value="{{ $totalDoadores }} doadores" readonly>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <input type="text" class="form-control" value="{{ $status }}" readonly>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoDoacoes').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($dadosGrafico)) !!},
            datasets: [{
                label: 'Valor Doado (R$)',
                data: {!! json_encode(array_values($dadosGrafico)) !!},
                backgroundColor: ['#4CAF50', '#FFC107', '#F44336', '#03A9F4'],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Doações Mensais' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection

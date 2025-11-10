@extends('layouts.dashboard')

@section('title', 'Relatórios - SCDI')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="bi bi-graph-up me-2"></i>
                        RELATÓRIOS DE CAMPANHAS - ADMINISTRAÇÃO
                    </h3>
                </div>

                <div class="card-body">
                    <!-- Filtros -->
                    <form action="{{ route('adm.relatorios.filtrar') }}" method="GET" class="mb-4">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label for="data_inicio" class="form-label">Data Início:</label>
                                <input type="date" name="data_inicio" class="form-control" value="{{ request('data_inicio') }}">
                            </div>

                            <div class="col-md-3">
                                <label for="data_fim" class="form-label">Data Fim:</label>
                                <input type="date" name="data_fim" class="form-control" value="{{ request('data_fim') }}">
                            </div>

                            <div class="col-md-4">
                                <label for="instituicao_id" class="form-label">Instituição:</label>
                                <select name="instituicao_id" class="form-select">
                                    <option value="">Todas as Instituições</option>
                                    @foreach($instituicoes as $instituicao)
                                        <option value="{{ $instituicao->id }}" {{ request('instituicao_id') == $instituicao->id ? 'selected' : '' }}>
                                            {{ $instituicao->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="bi bi-funnel me-1"></i> Filtrar
                                </button>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <a href="{{ route('adm.relatorios.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Limpar
                                </a>
                            </div>
                        </div>
                    </form>

                    @if($campanhas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Título</th>
                                        <th>Instituição</th>
                                        <th>Período</th>
                                        <th>Duração</th>
                                        <th>Total Arrecadado</th>
                                        <th>Qtd. Doações</th>
                                        <th>Qtd. Doadores</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($campanhas as $campanha)
                                        @php
                                            $dados = app('App\Http\Controllers\RelatorioController')->gerarDadosRelatorio($campanha);
                                            $estaAtiva = \Carbon\Carbon::parse($campanha->data_fim) > now();
                                        @endphp
                                        <tr>
                                            <td>{{ $campanha->id }}</td>
                                            <td>{{ $campanha->titulo }}</td>
                                            <td>{{ $campanha->instituicao->nome }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($campanha->data_inicio)->format('d/m/Y') }} -
                                                {{ \Carbon\Carbon::parse($campanha->data_fim)->format('d/m/Y') }}
                                            </td>
                                            <td class="text-center">{{ $dados['dias_duracao'] }} dias</td>
                                            <td class="text-success fw-bold">
                                                R$ {{ number_format($dados['total_arrecadado'], 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ $dados['quantidade_doacoes'] }}</td>
                                            <td class="text-center">{{ $dados['quantidade_doadores'] }}</td>
                                            <td class="text-center">
                                                @if($estaAtiva)
                                                    <span class="badge bg-success">Ativa</span>
                                                @else
                                                    <span class="badge bg-secondary">Finalizada</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('adm.relatorios.show', $campanha->id) }}" class="btn btn-info btn-sm" title="Ver Detalhes">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('adm.relatorios.exportar', $campanha->id) }}" class="btn btn-danger btn-sm" title="Exportar PDF">
                                                        <i class="bi bi-file-pdf"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-light">
                                        <td colspan="5" class="text-end"><strong>Totais:</strong></td>
                                        <td class="text-success fw-bold">
                                            <strong>R$ {{ number_format($campanhas->sum(function($campanha) {
                                                return $campanha->doacoes->sum('valor');
                                            }), 2, ',', '.') }}</strong>
                                        </td>
                                        <td class="text-center">
                                            <strong>{{ $campanhas->sum(function($campanha) {
                                                return $campanha->doacoes->count();
                                            }) }}</strong>
                                        </td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle me-2"></i>
                            Nenhuma campanha encontrada com os filtros aplicados.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

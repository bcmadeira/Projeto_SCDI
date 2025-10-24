@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar"></i>
                        RELATÓRIOS DE CAMPANHAS - ADMINISTRAÇÃO
                    </h3>

                    <!-- Filtros -->
                    <div class="card-tools">
                        <form action="{{ route('adm.relatorios.filtrar') }}" method="GET" class="form-inline">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="data_inicio" class="col-form-label">Data Início:</label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" name="data_inicio" class="form-control form-control-sm"
                                           value="{{ request('data_inicio') }}">
                                </div>

                                <div class="col-auto">
                                    <label for="data_fim" class="col-form-label">Data Fim:</label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" name="data_fim" class="form-control form-control-sm"
                                           value="{{ request('data_fim') }}">
                                </div>

                                <div class="col-auto">
                                    <select name="instituicao_id" class="form-control form-control-sm">
                                        <option value="">Todas as Instituições</option>
                                        @foreach($instituicoes as $instituicao)
                                            <option value="{{ $instituicao->id }}"
                                                {{ request('instituicao_id') == $instituicao->id ? 'selected' : '' }}>
                                                {{ $instituicao->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-filter"></i> Filtrar
                                    </button>
                                    <a href="{{ route('adm.relatorios.index') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-redo"></i> Limpar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    @if($campanhas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead class="thead-dark">
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
                                            $dados = app('App\Http\Controllers\Adm\RelatorioController')
                                                    ->gerarDadosRelatorio($campanha);
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
                                            <td class="text-success font-weight-bold">
                                                R$ {{ number_format($dados['total_arrecadado'], 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ $dados['quantidade_doacoes'] }}</td>
                                            <td class="text-center">{{ $dados['quantidade_doadores'] }}</td>
                                            <td class="text-center">
                                                @if($estaAtiva)
                                                    <span class="badge badge-success">Ativa</span>
                                                @else
                                                    <span class="badge badge-secondary">Finalizada</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('adm.relatorios.show', $campanha->id) }}"
                                                       class="btn btn-info btn-sm" title="Ver Detalhes">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('adm.relatorios.exportar', $campanha->id) }}"
                                                       class="btn btn-danger btn-sm" title="Exportar PDF">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light">
                                        <td colspan="5" class="text-right"><strong>Totais:</strong></td>
                                        <td class="text-success">
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
                            <i class="fas fa-info-circle"></i>
                            Nenhuma campanha encontrada com os filtros aplicados.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@extends('layouts.dashboard')

@section('title', 'Minhas Doações - SCDI')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/relatorio.css') }}">
@endpush

@section('content')
<div class="main-container">
    <div class="page-header mb-4">
        <h1 class="dashboard-title mb-2">Minhas Doações</h1>
        <p class="text-muted m-0">Acompanhe o histórico de todas as suas contribuições</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-number text-success fw-bold fs-2">{{ count($doacoes) }}</div>
                    <div class="stat-label text-muted">Total de Doações</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-number text-primary fw-bold fs-2">R$ 1.500,00</div>
                    <div class="stat-label text-muted">Total Doado</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-number text-info fw-bold fs-2">8</div>
                    <div class="stat-label text-muted">Campanhas Apoiadas</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-number text-warning fw-bold fs-2">12</div>
                    <div class="stat-label text-muted">Instituições Ajudadas</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3"><i class="bi bi-funnel"></i> Filtros</h5>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Data Inicial</label>
                    <input type="date" class="form-control" id="dataInicio">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Data Final</label>
                    <input type="date" class="form-control" id="dataFim">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Campanha</label>
                    <select class="form-select" id="campanhaFilter">
                        <option value="">Todas as Campanhas</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Tipo</label>
                    <select class="form-select" id="tipoFilter">
                        <option value="">Todos os Tipos</option>
                        <option value="dinheiro">Dinheiro</option>
                        <option value="material">Material</option>
                    </select>
                </div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button class="btn btn-success" onclick="filtrarDoacoes()">
                    <i class="bi bi-search"></i> Filtrar
                </button>
                <button class="btn btn-secondary" onclick="limparFiltros()">
                    <i class="bi bi-x-circle"></i> Limpar
                </button>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 mb-3">
        <button class="btn btn-danger" onclick="exportarPDF()">
            <i class="bi bi-file-pdf"></i> Exportar PDF
        </button>
        <button class="btn btn-success" onclick="exportarExcel()">
            <i class="bi bi-file-excel"></i> Exportar Excel
        </button>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-3 py-3">Data</th>
                            <th class="px-3 py-3">Campanha</th>
                            <th class="px-3 py-3">Instituição</th>
                            <th class="px-3 py-3">Tipo</th>
                            <th class="px-3 py-3">Valor/Descrição</th>
                            <th class="px-3 py-3">Status</th>
                            <th class="px-3 py-3 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tabelaDoacoes">
                @forelse($doacoes as $doacao)
                <tr>
                    <td class="px-3">{{ $doacao->created_at->format('d/m/Y') }}</td>
                    <td class="px-3">{{ $doacao->campanha->titulo ?? 'N/A' }}</td>
                    <td class="px-3">{{ $doacao->campanha->instituicao->nome ?? 'N/A' }}</td>
                    <td class="px-3"><span class="badge bg-success">{{ $doacao->tipo ?? 'Dinheiro' }}</span></td>
                    <td class="px-3">R$ {{ number_format($doacao->valor ?? 0, 2, ',', '.') }}</td>
                    <td class="px-3"><span class="badge bg-success">Confirmada</span></td>
                    <td class="px-3 text-center">
                        <button class="btn btn-sm btn-outline-primary btn-ver-comprovante" data-doacao-id="{{ $doacao->id }}" title="Ver Comprovante">
                            <i class="bi bi-file-text"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="px-3">15/01/2025</td>
                    <td class="px-3">Natal Solidário 2024</td>
                    <td class="px-3">ONG Esperança</td>
                    <td class="px-3"><span class="badge bg-success">Dinheiro</span></td>
                    <td class="px-3">R$ 150,00</td>
                    <td class="px-3"><span class="badge bg-success">Confirmada</span></td>
                    <td class="px-3 text-center">
                        <button class="btn btn-sm btn-outline-primary" onclick="verComprovante(1)" title="Ver Comprovante">
                            <i class="bi bi-file-text"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="px-3">12/01/2025</td>
                    <td class="px-3">Agasalho do Bem</td>
                    <td class="px-3">Casa do Menor</td>
                    <td class="px-3"><span class="badge bg-info">Material</span></td>
                    <td class="px-3">10 cobertores</td>
                    <td class="px-3"><span class="badge bg-primary">Entregue</span></td>
                    <td class="px-3 text-center">
                        <button class="btn btn-sm btn-outline-primary" onclick="verComprovante(2)" title="Ver Comprovante">
                            <i class="bi bi-file-text"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="px-3">10/01/2025</td>
                    <td class="px-3">Alimentação Emergencial</td>
                    <td class="px-3">Lar dos Idosos</td>
                    <td class="px-3"><span class="badge bg-success">Dinheiro</span></td>
                    <td class="px-3">R$ 200,00</td>
                    <td class="px-3"><span class="badge bg-success">Confirmada</span></td>
                    <td class="px-3 text-center">
                        <button class="btn btn-sm btn-outline-primary" onclick="verComprovante(3)" title="Ver Comprovante">
                            <i class="bi bi-file-text"></i>
                        </button>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Comprovante -->
<div class="modal fade" id="modalComprovante" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="bi bi-file-text"></i> Comprovante de Doação</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6">
                        <strong class="text-muted small">Protocolo:</strong>
                        <p class="mb-0" id="protocolo">DOA-2025-001</p>
                    </div>
                    <div class="col-6">
                        <strong class="text-muted small">Data:</strong>
                        <p class="mb-0" id="dataDoacao">15/01/2025</p>
                    </div>
                    <div class="col-12">
                        <strong class="text-muted small">Campanha:</strong>
                        <p class="mb-0" id="campanhaComprovante">Natal Solidário 2024</p>
                    </div>
                    <div class="col-12">
                        <strong class="text-muted small">Instituição:</strong>
                        <p class="mb-0" id="instituicaoComprovante">ONG Esperança</p>
                    </div>
                    <div class="col-6">
                        <strong class="text-muted small">Tipo:</strong>
                        <p class="mb-0" id="tipoComprovante">Dinheiro</p>
                    </div>
                    <div class="col-6">
                        <strong class="text-muted small">Valor:</strong>
                        <p class="mb-0 fw-bold text-success" id="valorComprovante">R$ 150,00</p>
                    </div>
                    <div class="col-12">
                        <strong class="text-muted small">Status:</strong>
                        <p class="mb-0"><span class="badge bg-success" id="statusComprovante">Confirmada</span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success w-100" onclick="baixarComprovante()">
                    <i class="bi bi-download"></i> Baixar Comprovante
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event delegation para botões de ver comprovante
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-ver-comprovante')) {
                const btn = e.target.closest('.btn-ver-comprovante');
                const doacaoId = btn.getAttribute('data-doacao-id');
                verComprovante(doacaoId);
            }
        });
    });

    function filtrarDoacoes() {
        alert('Filtro aplicado com sucesso!');
    }

    function limparFiltros() {
        document.getElementById('dataInicio').value = '';
        document.getElementById('dataFim').value = '';
        document.getElementById('campanhaFilter').value = '';
        document.getElementById('tipoFilter').value = '';
    }

    function exportarPDF() {
        alert('Relatório PDF em desenvolvimento!');
    }

    function exportarExcel() {
        alert('Relatório Excel em desenvolvimento!');
    }

    function verComprovante(id) {
        const modal = new bootstrap.Modal(document.getElementById('modalComprovante'));
        modal.show();
    }

    function baixarComprovante() {
        alert('Download do comprovante iniciado!');
    }
</script>
@endpush

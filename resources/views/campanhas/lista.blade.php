@extends('layouts.dashboard')

@section('title', 'Campanhas Disponíveis - SCDI')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/campanhas.css') }}">
@endpush

@section('content')
<div class="main-container">
    <div class="page-header">
        <h1 class="dashboard-title">Campanhas Disponíveis</h1>
        <p class="text-muted m-0">Escolha uma causa e faça sua doação</p>
    </div>

    <div class="filters-section">
        <div class="filter-row">
            <div class="form-group">
                <input type="text" class="form-control" id="buscar" placeholder="Buscar campanhas...">
            </div>
            <div class="form-group">
                <select class="form-select" id="categoriaFilter">
                    <option value="">Todas as Categorias</option>
                    <option value="alimentos">Alimentos</option>
                    <option value="roupas">Roupas</option>
                    <option value="medicamentos">Medicamentos</option>
                    <option value="brinquedos">Brinquedos</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-select" id="ordenarPor">
                    <option value="recentes">Mais Recentes</option>
                    <option value="populares">Mais Populares</option>
                    <option value="urgentes">Mais Urgentes</option>
                </select>
            </div>
        </div>
    </div>

    <div class="campaigns-grid" id="campanhasGrid">
        @forelse($campanhas ?? [] as $campanha)
        <div class="campaign-card">
            <div class="campaign-header">
                <h3 class="campaign-title">{{ $campanha->titulo }}</h3>
                <span class="status-badge status-ativa">Ativa</span>
            </div>
            <p class="campaign-meta"><strong>{{ $campanha->instituicao->nome ?? 'Instituição' }}</strong></p>
            <p class="text-muted small">{{ $campanha->descricao }}</p>
            <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width: 75%;"></div>
            </div>
            <p class="progress-text"><strong>Meta em progresso</strong></p>
            <div class="campaign-actions">
                <button class="btn btn-success flex-fill btn-doar" 
                        data-campanha-titulo="{{ $campanha->titulo }}" 
                        data-campanha-id="{{ $campanha->id }}">
                    <i class="bi bi-heart-fill"></i> Doar Agora
                </button>
                <a href="{{ route('campanhas.show', $campanha->id) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                Nenhuma campanha disponível no momento.
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal de Doação -->
<div id="modalDoacao" class="modal-overlay" onclick="fecharModal(event, 'modalDoacao')">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h3 class="modal-title"><i class="bi bi-heart-fill"></i> Realizar Doação</h3>
            <button class="modal-close" onclick="fecharModal(event, 'modalDoacao')">&times;</button>
        </div>
        <div>
            <h5 id="campanhaDoacao"></h5>
            <form id="formDoacao" action="{{ route('doacoes.store') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" id="campanha_id" name="campanha_id">
                
                <div class="mb-3">
                    <label class="form-label">Tipo de Doação</label>
                    <select class="form-select" id="tipoDoacao" name="tipo" required>
                        <option value="dinheiro">Dinheiro</option>
                        <option value="material">Material</option>
                    </select>
                </div>
                
                <div class="mb-3" id="valorGroup">
                    <label class="form-label">Valor</label>
                    <input type="number" class="form-control" id="valor" name="valor" min="1" step="0.01">
                </div>
                
                <div class="mb-3" id="descricaoGroup" style="display: none;">
                    <label class="form-label">Descrição do Material</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                </div>
                
                <button type="submit" class="btn btn-success w-100">Confirmar Doação</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Event delegation para botões de doar
document.addEventListener('DOMContentLoaded', function() {
    // Botões de doar
    document.querySelectorAll('.btn-doar').forEach(btn => {
        btn.addEventListener('click', function() {
            const titulo = this.getAttribute('data-campanha-titulo');
            const id = this.getAttribute('data-campanha-id');
            realizarDoacao(titulo, id);
        });
    });
    
    // Tipo de doação
    const tipoDoacaoSelect = document.getElementById('tipoDoacao');
    if (tipoDoacaoSelect) {
        tipoDoacaoSelect.addEventListener('change', function() {
            const valorGroup = document.getElementById('valorGroup');
            const descricaoGroup = document.getElementById('descricaoGroup');
            
            if (this.value === 'dinheiro') {
                valorGroup.style.display = 'block';
                descricaoGroup.style.display = 'none';
                document.getElementById('valor').required = true;
                document.getElementById('descricao').required = false;
            } else {
                valorGroup.style.display = 'none';
                descricaoGroup.style.display = 'block';
                document.getElementById('valor').required = false;
                document.getElementById('descricao').required = true;
            }
        });
    }
});

function realizarDoacao(titulo, campanhaId) {
    document.getElementById('campanhaDoacao').textContent = titulo;
    document.getElementById('campanha_id').value = campanhaId;
    document.getElementById('modalDoacao').style.display = 'flex';
}

function fecharModal(event, modalId) {
    if (event.target === event.currentTarget || event.target.classList.contains('modal-close')) {
        document.getElementById(modalId).style.display = 'none';
    }
}
</script>
@endpush

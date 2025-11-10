@extends('layouts.dashboard')

@section('title', 'Detalhes da Campanha - SCDI')

@push('styles')
<style>
    .campaign-detail-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin: 20px 0;
    }
    .campaign-meta {
        display: flex;
        gap: 20px;
        margin: 20px 0;
        flex-wrap: wrap;
    }
    .campaign-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
    }
</style>
@endpush

@section('content')
<div class="main-container">
    <div class="campaign-detail-card">
        <h3 class="card-title mb-4">{{ $campanha->titulo }}</h3>
        
        <div class="campaign-meta">
            <div class="campaign-meta-item">
                <i class="bi bi-calendar-check"></i>
                <span><strong>Início:</strong> {{ \Carbon\Carbon::parse($campanha->data_inicio)->format('d/m/Y') }}</span>
            </div>
            <div class="campaign-meta-item">
                <i class="bi bi-calendar-x"></i>
                <span><strong>Término:</strong> {{ \Carbon\Carbon::parse($campanha->data_fim)->format('d/m/Y') }}</span>
            </div>
            @if($campanha->instituicao)
            <div class="campaign-meta-item">
                <i class="bi bi-building"></i>
                <span><strong>Instituição:</strong> {{ $campanha->instituicao->nome }}</span>
            </div>
            @endif
        </div>

        <div class="campaign-description">
            <h5 class="mb-3">Descrição</h5>
            <p>{{ $campanha->descricao }}</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('campanhas.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar para Campanhas
            </a>
            <button class="btn btn-success btn-doar-detalhe" 
                    data-campanha-titulo="{{ $campanha->titulo }}" 
                    data-campanha-id="{{ $campanha->id }}">
                <i class="bi bi-heart-fill"></i> Doar para esta Campanha
            </button>
        </div>
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
                <input type="hidden" id="campanha_id" name="campanha_id" value="{{ $campanha->id }}">
                
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
document.addEventListener('DOMContentLoaded', function() {
    // Botão de doar na página de detalhes
    const btnDoar = document.querySelector('.btn-doar-detalhe');
    if (btnDoar) {
        btnDoar.addEventListener('click', function() {
            const titulo = this.getAttribute('data-campanha-titulo');
            const id = this.getAttribute('data-campanha-id');
            realizarDoacao(titulo, id);
        });
    }
    
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

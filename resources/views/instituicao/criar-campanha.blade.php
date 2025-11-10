@extends('layouts.dashboard')

@section('title', 'Criar Campanha - SCDI')

@push('styles')
<style>
    .page-container {
        padding: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .page-header {
        margin-bottom: 30px;
    }
    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .card-header {
        background: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        padding: 20px;
        border-radius: 12px 12px 0 0 !important;
    }
    .card-body {
        padding: 25px;
    }
    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-label {
        font-weight: 500;
        color: #555;
        margin-bottom: 8px;
    }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px 15px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    }
    .btn {
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-flag-fill me-2"></i>
            Criar Nova Campanha
        </h1>
        <p class="text-muted">Preencha os dados para criar uma nova campanha de arrecadação</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('campanhas.store') }}" method="POST">
        @csrf

        <!-- Informações Básicas -->
        <div class="card">
            <div class="card-header">
                <h3 class="section-title">
                    <i class="bi bi-info-circle"></i>
                    Informações Básicas
                </h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="titulo">Título da Campanha *</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" 
                           value="{{ old('titulo') }}" placeholder="Ex: Natal Solidário 2025" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" class="form-control" rows="4"
                              placeholder="Descreva os objetivos e detalhes da sua campanha...">{{ old('descricao') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="categoria">Categoria</label>
                        <select id="categoria" name="categoria" class="form-select">
                            <option value="geral" {{ old('categoria') == 'geral' ? 'selected' : '' }}>Geral</option>
                            <option value="alimentos" {{ old('categoria') == 'alimentos' ? 'selected' : '' }}>Alimentos</option>
                            <option value="roupas" {{ old('categoria') == 'roupas' ? 'selected' : '' }}>Roupas</option>
                            <option value="medicamentos" {{ old('categoria') == 'medicamentos' ? 'selected' : '' }}>Medicamentos</option>
                            <option value="dinheiro" {{ old('categoria') == 'dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                            <option value="outros" {{ old('categoria') == 'outros' ? 'selected' : '' }}>Outros</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="meta_valor">Meta de Arrecadação (R$)</label>
                        <input type="number" id="meta_valor" name="meta_valor" class="form-control" 
                               value="{{ old('meta_valor') }}" placeholder="0.00" step="0.01" min="0">
                    </div>
                </div>
            </div>
        </div>

        <!-- Período da Campanha -->
        <div class="card">
            <div class="card-header">
                <h3 class="section-title">
                    <i class="bi bi-calendar3"></i>
                    Período da Campanha
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="data_inicio">Data de Início *</label>
                        <input type="date" id="data_inicio" name="data_inicio" class="form-control" 
                               value="{{ old('data_inicio') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="data_fim">Data de Término *</label>
                        <input type="date" id="data_fim" name="data_fim" class="form-control" 
                               value="{{ old('data_fim') }}" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botões -->
        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('dashboard.instituicao') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle me-1"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle me-1"></i> Criar Campanha
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Validação de datas
document.getElementById('data_fim').addEventListener('change', function() {
    const dataInicio = document.getElementById('data_inicio').value;
    const dataFim = this.value;
    
    if (dataInicio && dataFim && dataFim < dataInicio) {
        alert('A data de término não pode ser anterior à data de início!');
        this.value = '';
    }
});

// Data mínima = hoje
const hoje = new Date().toISOString().split('T')[0];
document.getElementById('data_inicio').setAttribute('min', hoje);
document.getElementById('data_fim').setAttribute('min', hoje);
</script>
@endpush


@extends('layouts.dashboard')

@section('title', 'Minhas Campanhas - SCDI')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h2>
                    <i class="bi bi-flag-fill me-2"></i>
                    Minhas Campanhas
                </h2>
                <p class="text-muted">Gerencie todas as suas campanhas</p>
            </div>
            <a href="{{ route('campanhas.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Nova Campanha
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($campanhas->count() > 0)
        <div class="row">
            @foreach($campanhas as $campanha)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    @if($campanha->imagem)
                        <img src="{{ asset('storage/' . $campanha->imagem) }}" class="card-img-top" alt="{{ $campanha->titulo }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-gradient" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-flag-fill text-white" style="font-size: 4rem; opacity: 0.5;"></i>
                        </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $campanha->titulo }}</h5>
                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit($campanha->descricao, 100) }}
                        </p>
                        
                        <div class="mb-3">
                            @php
                                $dataInicio = \Carbon\Carbon::parse($campanha->data_inicio);
                                $dataFim = \Carbon\Carbon::parse($campanha->data_fim);
                                $hoje = \Carbon\Carbon::now();
                                $ativa = $hoje->between($dataInicio, $dataFim);
                                $encerrada = $hoje->greaterThan($dataFim);
                            @endphp
                            
                            @if($encerrada)
                                <span class="badge bg-secondary">
                                    <i class="bi bi-x-circle me-1"></i>Encerrada
                                </span>
                            @elseif($ativa)
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i>Ativa
                                </span>
                            @else
                                <span class="badge bg-info">
                                    <i class="bi bi-clock me-1"></i>Em breve
                                </span>
                            @endif
                            
                            <span class="badge bg-light text-dark ms-2">
                                <i class="bi bi-heart me-1"></i>{{ $campanha->doacoes_count ?? 0 }} doações
                            </span>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ $dataInicio->format('d/m/Y') }} - {{ $dataFim->format('d/m/Y') }}
                            </small>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('campanhas.show', $campanha->id) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                                <i class="bi bi-eye me-1"></i>Visualizar
                            </a>
                            <button class="btn btn-sm btn-outline-secondary" data-campanha-id="{{ $campanha->id }}" onclick="editarCampanha(this)">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" data-campanha-id="{{ $campanha->id }}" onclick="excluirCampanha(this)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-flag" style="font-size: 4rem; color: #ccc;"></i>
            <h4 class="mt-3 text-muted">Nenhuma campanha criada</h4>
            <p class="text-muted">Comece criando sua primeira campanha para arrecadar doações</p>
            <a href="{{ route('campanhas.create') }}" class="btn btn-primary mt-3">
                <i class="bi bi-plus-circle me-2"></i>
                Criar Primeira Campanha
            </a>
        </div>
    @endif
</div>

<style>
.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.card-img-top {
    transition: transform 0.3s ease;
}

.card:hover .card-img-top {
    transform: scale(1.05);
}
</style>

<script>
function editarCampanha(button) {
    const id = button.getAttribute('data-campanha-id');
    alert('Funcionalidade de edição será implementada em breve!');
    // Futuramente: window.location.href = `/campanhas/${id}/editar`;
}

function excluirCampanha(button) {
    const id = button.getAttribute('data-campanha-id');
    if(confirm('Tem certeza que deseja excluir esta campanha?')) {
        alert('Funcionalidade de exclusão será implementada em breve!');
        // Futuramente: fazer requisição DELETE para /campanhas/${id}
    }
}
</script>
@endsection

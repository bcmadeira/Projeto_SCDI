// JavaScript para Minhas Campanhas
document.addEventListener('DOMContentLoaded', function() {
    // Dados mockados das campanhas
    const campanhasMock = [
        {
            id: 1,
            nome: 'Campanha Natal Solidário',
            descricao: 'Arrecadação de brinquedos para crianças carentes',
            meta: 1000,
            arrecadado: 750,
            status: 'ativa',
            dataInicio: '2024-11-01',
            dataFim: '2024-12-24',
            instituicao: 'ONG Esperança'
        },
        {
            id: 2,
            nome: 'Agasalho do Bem',
            descricao: 'Doação de roupas de inverno',
            meta: 500,
            arrecadado: 500,
            status: 'finalizada',
            dataInicio: '2024-05-01',
            dataFim: '2024-06-30',
            instituicao: 'Casa do Menor'
        },
        {
            id: 3,
            nome: 'Alimentação Emergencial',
            descricao: 'Cestas básicas para famílias necessitadas',
            meta: 2000,
            arrecadado: 1200,
            status: 'pausada',
            dataInicio: '2024-10-01',
            dataFim: '2024-11-30',
            instituicao: 'Lar dos Idosos'
        },
        {
            id: 4,
            nome: 'Medicamentos Essenciais',
            descricao: 'Arrecadação de medicamentos básicos',
            meta: 800,
            arrecadado: 320,
            status: 'ativa',
            dataInicio: '2024-10-15',
            dataFim: '2024-12-15',
            instituicao: 'ONG Esperança'
        }
    ];
    
    let campanhasFiltradas = [...campanhasMock];
    
    // Renderizar campanhas
    function renderizarCampanhas() {
        const grid = document.getElementById('campanhasGrid');
        const emptyState = document.getElementById('emptyState');
        
        if (campanhasFiltradas.length === 0) {
            grid.style.display = 'none';
            emptyState.style.display = 'block';
            return;
        }
        
        grid.style.display = 'grid';
        emptyState.style.display = 'none';
        
        grid.innerHTML = '';
        
        campanhasFiltradas.forEach(campanha => {
            const progresso = (campanha.arrecadado / campanha.meta) * 100;
            const statusClass = `status-${campanha.status}`;
            const statusText = campanha.status.charAt(0).toUpperCase() + campanha.status.slice(1);
            
            const card = `
                <div class="campaign-card">
                    <div class="campaign-header">
                        <div class="campaign-title">${campanha.nome}</div>
                        <div class="campaign-subtitle">${campanha.instituicao}</div>
                    </div>
                    <div class="campaign-body">
                        <div class="campaign-status ${statusClass}">${statusText}</div>
                        
                        <div class="campaign-info">
                            <div class="campaign-info-item">
                                <div class="campaign-info-label">Meta</div>
                                <div class="campaign-info-value">${formatarNumero(campanha.meta)}</div>
                            </div>
                            <div class="campaign-info-item">
                                <div class="campaign-info-label">Arrecadado</div>
                                <div class="campaign-info-value">${formatarNumero(campanha.arrecadado)}</div>
                            </div>
                            <div class="campaign-info-item">
                                <div class="campaign-info-label">Progresso</div>
                                <div class="campaign-info-value">${progresso.toFixed(1)}%</div>
                            </div>
                        </div>
                        
                        <div class="campaign-progress">
                            <div class="progress-bar-custom">
                                <div class="progress-fill" style="width: ${Math.min(progresso, 100)}%"></div>
                            </div>
                            <div class="progress-text">
                                ${formatarData(campanha.dataInicio)} - ${formatarData(campanha.dataFim)}
                            </div>
                        </div>
                        
                        <div class="campaign-actions">
                            <button class="btn-action btn-view" onclick="verCampanha(${campanha.id})">
                                <i class="bi bi-eye"></i> Ver
                            </button>
                            <button class="btn-action btn-edit" onclick="editarCampanha(${campanha.id})">
                                <i class="bi bi-pencil"></i> Editar
                            </button>
                            ${campanha.status === 'ativa' ? 
                                `<button class="btn-action btn-pause" onclick="pausarCampanha(${campanha.id})">
                                    <i class="bi bi-pause"></i> Pausar
                                </button>` : 
                                campanha.status === 'pausada' ?
                                `<button class="btn-action btn-view" onclick="reativarCampanha(${campanha.id})">
                                    <i class="bi bi-play"></i> Reativar
                                </button>` : ''
                            }
                        </div>
                    </div>
                </div>
            `;
            
            grid.innerHTML += card;
        });
    }
    
    // Formatar número
    function formatarNumero(numero) {
        return numero.toLocaleString('pt-BR');
    }
    
    // Formatar data
    function formatarData(dataString) {
        const data = new Date(dataString);
        return data.toLocaleDateString('pt-BR');
    }
    
    // Aplicar filtros
    window.aplicarFiltros = function() {
        const status = document.getElementById('statusFilter').value;
        const ordenarPor = document.getElementById('ordenarPor').value;
        const buscar = document.getElementById('buscar').value.toLowerCase();
        
        // Filtrar
        campanhasFiltradas = campanhasMock.filter(campanha => {
            let passou = true;
            
            // Filtro por status
            if (status && campanha.status !== status) {
                passou = false;
            }
            
            // Filtro por busca
            if (buscar && !campanha.nome.toLowerCase().includes(buscar)) {
                passou = false;
            }
            
            return passou;
        });
        
        // Ordenar
        campanhasFiltradas.sort((a, b) => {
            switch (ordenarPor) {
                case 'nome':
                    return a.nome.localeCompare(b.nome);
                case 'progresso':
                    const progressoA = (a.arrecadado / a.meta) * 100;
                    const progressoB = (b.arrecadado / b.meta) * 100;
                    return progressoB - progressoA;
                case 'data':
                default:
                    return new Date(b.dataInicio) - new Date(a.dataInicio);
            }
        });
        
        renderizarCampanhas();
    };
    
    // Ações das campanhas
    window.verCampanha = function(id) {
        const campanha = campanhasMock.find(c => c.id === id);
        if (campanha) {
            const progresso = (campanha.arrecadado / campanha.meta) * 100;
            alert(`Detalhes da Campanha:\n\nNome: ${campanha.nome}\nDescrição: ${campanha.descricao}\nInstituição: ${campanha.instituicao}\nMeta: ${formatarNumero(campanha.meta)}\nArrecadado: ${formatarNumero(campanha.arrecadado)}\nProgresso: ${progresso.toFixed(1)}%\nStatus: ${campanha.status}\nPeríodo: ${formatarData(campanha.dataInicio)} até ${formatarData(campanha.dataFim)}`);
        }
    };
    
    window.editarCampanha = function(id) {
        // Redirecionar para página de edição
        window.location.href = `criar-campanha.html?edit=${id}`;
    };
    
    window.pausarCampanha = function(id) {
        if (confirm('Tem certeza que deseja pausar esta campanha?')) {
            const campanha = campanhasMock.find(c => c.id === id);
            if (campanha) {
                campanha.status = 'pausada';
                renderizarCampanhas();
                alert('Campanha pausada com sucesso!');
            }
        }
    };
    
    window.reativarCampanha = function(id) {
        if (confirm('Tem certeza que deseja reativar esta campanha?')) {
            const campanha = campanhasMock.find(c => c.id === id);
            if (campanha) {
                campanha.status = 'ativa';
                renderizarCampanhas();
                alert('Campanha reativada com sucesso!');
            }
        }
    };
    
    // Filtro em tempo real na busca
    document.getElementById('buscar').addEventListener('input', function() {
        aplicarFiltros();
    });
    
    document.getElementById('statusFilter').addEventListener('change', function() {
        aplicarFiltros();
    });
    
    document.getElementById('ordenarPor').addEventListener('change', function() {
        aplicarFiltros();
    });
    
    // Inicializar página
    renderizarCampanhas();
});

// Funções de Modal
function abrirNotificacoes(event) {
    event.preventDefault();
    const modal = document.getElementById('modalNotificacoes');
    modal.style.display = 'flex';
    
    setTimeout(() => {
        const notificacoesNaoLidas = document.querySelectorAll('.notification-item.unread');
        notificacoesNaoLidas.forEach(notif => {
            notif.classList.remove('unread');
            notif.classList.add('read');
        });
        
        const badge = document.querySelector('.notification-badge');
        if (badge) {
            badge.style.opacity = '0';
            setTimeout(() => {
                badge.textContent = '0';
                badge.style.display = 'none';
            }, 300);
        }
    }, 1000);
}

function abrirSobre(event) {
    event.preventDefault();
    const modal = document.getElementById('modalSobre');
    modal.style.display = 'flex';
}

function abrirConfiguracoes(event) {
    event.preventDefault();
    const modal = document.getElementById('modalConfiguracoes');
    modal.style.display = 'flex';
}

function abrirContato(event) {
    event.preventDefault();
    const modal = document.getElementById('modalContato');
    modal.style.display = 'flex';
}

function fecharModal(event, modalId) {
    event.preventDefault();
    const modal = document.getElementById(modalId);
    modal.style.display = 'none';
}

function salvarConfiguracoes() {
    alert('Configurações salvas com sucesso!');
    fecharModal(event, 'modalConfiguracoes');
}

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('.modal-overlay');
        modals.forEach(modal => {
            if (modal.style.display === 'flex') {
                modal.style.display = 'none';
            }
        });
    }
});
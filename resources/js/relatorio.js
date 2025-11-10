// JavaScript para relatório de doações
document.addEventListener('DOMContentLoaded', function() {
    // Dados mockados das doações
    const doacoesMock = [
        {
            id: 1,
            doador: 'João Silva',
            instituicao: 'ONG Esperança',
            tipo: 'Alimentos',
            valor: '50 kg',
            data: '2024-10-15',
            status: 'entregue'
        },
        {
            id: 2,
            doador: 'Maria Santos',
            instituicao: 'Casa do Menor',
            tipo: 'Roupas',
            valor: '30 peças',
            data: '2024-10-18',
            status: 'confirmada'
        },
        {
            id: 3,
            doador: 'Carlos Oliveira',
            instituicao: 'Lar dos Idosos',
            tipo: 'Medicamentos',
            valor: 'R$ 250,00',
            data: '2024-10-20',
            status: 'pendente'
        },
        {
            id: 4,
            doador: 'Ana Costa',
            instituicao: 'ONG Esperança',
            tipo: 'Dinheiro',
            valor: 'R$ 500,00',
            data: '2024-10-22',
            status: 'confirmada'
        },
        {
            id: 5,
            doador: 'Pedro Mendes',
            instituicao: 'Casa do Menor',
            tipo: 'Brinquedos',
            valor: '15 unidades',
            data: '2024-10-25',
            status: 'entregue'
        }
    ];
    
    let doacoesFiltradas = [...doacoesMock];
    
    // Atualizar estatísticas
    function atualizarEstatisticas() {
        const total = doacoesFiltradas.length;
        const pendentes = doacoesFiltradas.filter(d => d.status === 'pendente').length;
        const confirmadas = doacoesFiltradas.filter(d => d.status === 'confirmada').length;
        const entregues = doacoesFiltradas.filter(d => d.status === 'entregue').length;
        
        document.getElementById('totalDoacoes').textContent = total;
        document.getElementById('doacoesPendentes').textContent = pendentes;
        document.getElementById('doacoesConfirmadas').textContent = confirmadas;
        document.getElementById('doacoesEntregues').textContent = entregues;
    }
    
    // Renderizar tabela
    function renderizarTabela() {
        const tbody = document.getElementById('tabelaDoacoes');
        tbody.innerHTML = '';
        
        doacoesFiltradas.forEach(doacao => {
            const statusClass = `status-${doacao.status}`;
            const statusText = doacao.status.charAt(0).toUpperCase() + doacao.status.slice(1);
            
            const row = `
                <tr>
                    <td>#${doacao.id.toString().padStart(3, '0')}</td>
                    <td>${doacao.doador}</td>
                    <td>${doacao.instituicao}</td>
                    <td>${doacao.tipo}</td>
                    <td>${doacao.valor}</td>
                    <td>${formatarData(doacao.data)}</td>
                    <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" onclick="verDetalhes(${doacao.id})">
                            <i class="bi bi-eye"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    }
    
    // Formatar data
    function formatarData(dataString) {
        const data = new Date(dataString);
        return data.toLocaleDateString('pt-BR');
    }
    
    // Aplicar filtros
    window.aplicarFiltros = function() {
        const dataInicio = document.getElementById('dataInicio').value;
        const dataFim = document.getElementById('dataFim').value;
        const status = document.getElementById('statusFilter').value;
        const instituicao = document.getElementById('instituicaoFilter').value;
        
        doacoesFiltradas = doacoesMock.filter(doacao => {
            let passou = true;
            
            // Filtro por data de início
            if (dataInicio && doacao.data < dataInicio) {
                passou = false;
            }
            
            // Filtro por data de fim
            if (dataFim && doacao.data > dataFim) {
                passou = false;
            }
            
            // Filtro por status
            if (status && doacao.status !== status) {
                passou = false;
            }
            
            // Filtro por instituição (simulado)
            if (instituicao) {
                const instituicoes = {
                    '1': 'ONG Esperança',
                    '2': 'Casa do Menor',
                    '3': 'Lar dos Idosos'
                };
                if (doacao.instituicao !== instituicoes[instituicao]) {
                    passou = false;
                }
            }
            
            return passou;
        });
        
        renderizarTabela();
        atualizarEstatisticas();
    };
    
    // Exportar relatório
    window.exportarRelatorio = function() {
        // Criar CSV
        let csv = 'ID,Doador,Instituição,Tipo,Valor/Qtd,Data,Status\n';
        
        doacoesFiltradas.forEach(doacao => {
            csv += `#${doacao.id.toString().padStart(3, '0')},${doacao.doador},${doacao.instituicao},${doacao.tipo},${doacao.valor},${formatarData(doacao.data)},${doacao.status}\n`;
        });
        
        // Download do arquivo
        const blob = new Blob([csv], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `relatorio_doacoes_${new Date().toISOString().split('T')[0]}.csv`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
        
        alert('Relatório exportado com sucesso!');
    };
    
    // Ver detalhes da doação
    window.verDetalhes = function(id) {
        const doacao = doacoesMock.find(d => d.id === id);
        if (doacao) {
            alert(`Detalhes da Doação #${id}:\n\nDoador: ${doacao.doador}\nInstituição: ${doacao.instituicao}\nTipo: ${doacao.tipo}\nValor/Quantidade: ${doacao.valor}\nData: ${formatarData(doacao.data)}\nStatus: ${doacao.status}`);
        }
    };
    
    // Inicializar página
    renderizarTabela();
    atualizarEstatisticas();
    
    // Definir datas padrão (último mês)
    const hoje = new Date();
    const umMesAtras = new Date();
    umMesAtras.setMonth(hoje.getMonth() - 1);
    
    document.getElementById('dataInicio').value = umMesAtras.toISOString().split('T')[0];
    document.getElementById('dataFim').value = hoje.toISOString().split('T')[0];
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
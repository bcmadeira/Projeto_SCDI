// JavaScript para criar campanha com calendário
document.addEventListener('DOMContentLoaded', function() {
    let dataInicio = null;
    let dataFim = null;
    let currentMonthInicio = new Date();
    let currentMonthFim = new Date();
    
    const meses = [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];
    
    const diasSemana = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
    
    // Inicializar calendários
    function inicializarCalendarios() {
        renderizarCalendario('calendarInicio', currentMonthInicio, 'inicio');
        renderizarCalendario('calendarFim', currentMonthFim, 'fim');
    }
    
    // Renderizar calendário
    function renderizarCalendario(containerId, mes, tipo) {
        const container = document.getElementById(containerId);
        const ano = mes.getFullYear();
        const mesAtual = mes.getMonth();
        
        // Cabeçalho do calendário
        const header = `
            <div class="calendar-header">
                <button type="button" class="calendar-nav" onclick="navegarMes('${tipo}', -1)">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <div class="calendar-month">${meses[mesAtual]} ${ano}</div>
                <button type="button" class="calendar-nav" onclick="navegarMes('${tipo}', 1)">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        `;
        
        // Grade do calendário
        let grid = '<div class="calendar-grid">';
        
        // Cabeçalhos dos dias da semana
        diasSemana.forEach(dia => {
            grid += `<div class="calendar-day-header">${dia}</div>`;
        });
        
        // Primeiro dia do mês e último dia do mês anterior
        const primeiroDia = new Date(ano, mesAtual, 1);
        const ultimoDia = new Date(ano, mesAtual + 1, 0);
        const primeiraDiaSemana = primeiroDia.getDay();
        
        // Dias do mês anterior
        const ultimoDiaMesAnterior = new Date(ano, mesAtual, 0).getDate();
        for (let i = primeiraDiaSemana - 1; i >= 0; i--) {
            const dia = ultimoDiaMesAnterior - i;
            grid += `<div class="calendar-day other-month">${dia}</div>`;
        }
        
        // Dias do mês atual
        const hoje = new Date();
        for (let dia = 1; dia <= ultimoDia.getDate(); dia++) {
            const dataAtual = new Date(ano, mesAtual, dia);
            const isHoje = dataAtual.toDateString() === hoje.toDateString();
            const isSelected = (tipo === 'inicio' && dataInicio && dataAtual.toDateString() === dataInicio.toDateString()) ||
                              (tipo === 'fim' && dataFim && dataAtual.toDateString() === dataFim.toDateString());
            const isPassed = dataAtual < hoje;
            
            let classes = 'calendar-day';
            if (isHoje) classes += ' today';
            if (isSelected) classes += ' selected';
            if (isPassed && !isHoje) classes += ' other-month';
            
            const clickable = !isPassed || isHoje;
            const onclick = clickable ? `onclick="selecionarData('${tipo}', ${ano}, ${mesAtual}, ${dia})"` : '';
            
            grid += `<div class="${classes}" ${onclick}>${dia}</div>`;
        }
        
        // Dias do próximo mês para completar a grade
        const diasRestantes = 42 - (primeiraDiaSemana + ultimoDia.getDate());
        for (let dia = 1; dia <= diasRestantes; dia++) {
            grid += `<div class="calendar-day other-month">${dia}</div>`;
        }
        
        grid += '</div>';
        
        container.innerHTML = header + grid;
    }
    
    // Navegar entre meses
    window.navegarMes = function(tipo, direcao) {
        if (tipo === 'inicio') {
            currentMonthInicio.setMonth(currentMonthInicio.getMonth() + direcao);
            renderizarCalendario('calendarInicio', currentMonthInicio, 'inicio');
        } else {
            currentMonthFim.setMonth(currentMonthFim.getMonth() + direcao);
            renderizarCalendario('calendarFim', currentMonthFim, 'fim');
        }
    };
    
    // Selecionar data
    window.selecionarData = function(tipo, ano, mes, dia) {
        const dataSelecionada = new Date(ano, mes, dia);
        
        if (tipo === 'inicio') {
            dataInicio = dataSelecionada;
            document.getElementById('dataInicioDisplay').textContent = formatarData(dataInicio);
            document.getElementById('dataInicioDisplay').classList.add('selected');
            
            // Se a data de fim for anterior à de início, resetar
            if (dataFim && dataFim <= dataInicio) {
                dataFim = null;
                document.getElementById('dataFimDisplay').textContent = 'Selecione a data de término';
                document.getElementById('dataFimDisplay').classList.remove('selected');
            }
            
            renderizarCalendario('calendarInicio', currentMonthInicio, 'inicio');
            renderizarCalendario('calendarFim', currentMonthFim, 'fim');
        } else {
            if (!dataInicio) {
                alert('Selecione primeiro a data de início!');
                return;
            }
            
            if (dataSelecionada <= dataInicio) {
                alert('A data de término deve ser posterior à data de início!');
                return;
            }
            
            dataFim = dataSelecionada;
            document.getElementById('dataFimDisplay').textContent = formatarData(dataFim);
            document.getElementById('dataFimDisplay').classList.add('selected');
            
            renderizarCalendario('calendarFim', currentMonthFim, 'fim');
        }
    };
    
    // Formatar data
    function formatarData(data) {
        return data.toLocaleDateString('pt-BR');
    }
    
    // Validação do formulário
    document.getElementById('campanhaForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validar datas
        if (!dataInicio || !dataFim) {
            alert('Por favor, selecione as datas de início e término da campanha!');
            return;
        }
        
        // Coletar dados do formulário
        const formData = new FormData(this);
        const dados = Object.fromEntries(formData);
        
        // Adicionar datas
        dados.dataInicio = dataInicio.toISOString().split('T')[0];
        dados.dataFim = dataFim.toISOString().split('T')[0];
        
        // Validações básicas
        if (!dados.titulo.trim()) {
            alert('O título da campanha é obrigatório!');
            return;
        }
        
        if (!dados.descricao.trim()) {
            alert('A descrição da campanha é obrigatória!');
            return;
        }
        
        if (!dados.categoria) {
            alert('Selecione uma categoria!');
            return;
        }
        
        if (!dados.meta || dados.meta <= 0) {
            alert('A meta deve ser um valor positivo!');
            return;
        }
        
        if (!dados.tipoRecebimento) {
            alert('Selecione o tipo de recebimento!');
            return;
        }
        
        if (!dados.prioridade) {
            alert('Selecione a prioridade da campanha!');
            return;
        }
        
        // Simular envio
        console.log('Dados da campanha:', dados);
        
        // Simular sucesso
        alert('Campanha criada com sucesso!');
        window.location.href = 'minhas-campanhas.html';
    });
    
    // Máscara para o campo meta (apenas números)
    document.getElementById('meta').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        e.target.value = value;
    });
    
    // Inicializar
    inicializarCalendarios();
    
    // Verificar se está editando uma campanha existente
    const urlParams = new URLSearchParams(window.location.search);
    const editId = urlParams.get('edit');
    
    if (editId) {
        // Simular carregamento de dados para edição
        document.querySelector('.form-title').textContent = 'Editar Campanha';
        document.querySelector('.form-subtitle').textContent = 'Atualize os dados da campanha';
        document.querySelector('button[type="submit"]').textContent = 'ATUALIZAR CAMPANHA';
        
        // Aqui você carregaria os dados da campanha do backend
        // Por enquanto, vamos simular alguns dados
        setTimeout(() => {
            document.getElementById('titulo').value = 'Campanha Teste';
            document.getElementById('descricao').value = 'Descrição da campanha teste';
            document.getElementById('categoria').value = 'alimentos';
            document.getElementById('meta').value = '1000';
            document.getElementById('tipoRecebimento').value = 'ambos';
            document.getElementById('prioridade').value = 'alta';
        }, 100);
    }
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
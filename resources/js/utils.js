/**
 * Utils - SCDI
 * Funções utilitárias compartilhadas entre todas as páginas
 */

/**
 * Abre o modal de notificações e marca todas como lidas
 * @param {Event} event - Evento de clique
 */
function abrirNotificacoes(event) {
    event.preventDefault();
    const modal = document.getElementById('modalNotificacoes');
    if (modal) {
        modal.style.display = 'flex';
        
        // Animar remoção do badge após 1 segundo
        setTimeout(() => {
            const notifs = document.querySelectorAll('.notification-item');
            notifs.forEach(notif => {
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
}

/**
 * Abre o modal "Sobre"
 * @param {Event} event - Evento de clique
 */
function abrirSobre(event) {
    event.preventDefault();
    const modal = document.getElementById('modalSobre');
    if (modal) {
        modal.style.display = 'flex';
    }
}

/**
 * Abre o modal de configurações
 * @param {Event} event - Evento de clique
 */
function abrirConfiguracoes(event) {
    event.preventDefault();
    const modal = document.getElementById('modalConfiguracoes');
    if (modal) {
        modal.style.display = 'flex';
    }
}

/**
 * Abre o modal de contato
 * @param {Event} event - Evento de clique
 */
function abrirContato(event) {
    event.preventDefault();
    const modal = document.getElementById('modalContato');
    if (modal) {
        modal.style.display = 'flex';
    }
}

/**
 * Abre o modal de perfil (doadores)
 * @param {Event} event - Evento de clique
 */
function abrirPerfil(event) {
    event.preventDefault();
    const modal = document.getElementById('modalPerfil');
    if (modal) {
        modal.style.display = 'flex';
    }
}

/**
 * Fecha um modal específico
 * @param {Event} event - Evento de clique
 * @param {string} modalId - ID do modal a ser fechado
 */
function fecharModal(event, modalId) {
    if (event) {
        event.preventDefault();
    }
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
    }
}

/**
 * Salva as configurações do usuário
 */
function salvarConfiguracoes() {
    alert('Configurações salvas com sucesso!');
    fecharModal(null, 'modalConfiguracoes');
}

/**
 * Formata um número como moeda brasileira
 * @param {number} valor - Valor a ser formatado
 * @returns {string} - Valor formatado (ex: "R$ 1.234,56")
 */
function formatarMoeda(valor) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(valor);
}

/**
 * Formata uma data para o padrão brasileiro
 * @param {Date|string} data - Data a ser formatada
 * @returns {string} - Data formatada (ex: "08/11/2025")
 */
function formatarData(data) {
    const d = new Date(data);
    return d.toLocaleDateString('pt-BR');
}

/**
 * Formata data e hora para o padrão brasileiro
 * @param {Date|string} data - Data/hora a ser formatada
 * @returns {string} - Data/hora formatada (ex: "08/11/2025 14:30")
 */
function formatarDataHora(data) {
    const d = new Date(data);
    return d.toLocaleString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

/**
 * Atualiza a hora da última atualização no elemento
 * @param {string} elementId - ID do elemento a ser atualizado (padrão: 'ultimaAtualizacao')
 */
function atualizarHoraAtual(elementId = 'ultimaAtualizacao') {
    const elemento = document.getElementById(elementId);
    if (elemento) {
        elemento.textContent = formatarDataHora(new Date());
    }
}

/**
 * Valida um email
 * @param {string} email - Email a ser validado
 * @returns {boolean} - true se válido, false caso contrário
 */
function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

/**
 * Valida um CPF
 * @param {string} cpf - CPF a ser validado
 * @returns {boolean} - true se válido, false caso contrário
 */
function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]/g, '');
    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;
    
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.charAt(9))) return false;
    
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    return resto === parseInt(cpf.charAt(10));
}

/**
 * Mascara para CPF
 * @param {string} value - Valor a ser mascarado
 * @returns {string} - CPF mascarado (ex: "123.456.789-00")
 */
function mascaraCPF(value) {
    return value
        .replace(/\D/g, '')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
}

/**
 * Mascara para telefone
 * @param {string} value - Valor a ser mascarado
 * @returns {string} - Telefone mascarado (ex: "(11) 98765-4321")
 */
function mascaraTelefone(value) {
    return value
        .replace(/\D/g, '')
        .replace(/(\d{2})(\d)/, '($1) $2')
        .replace(/(\d{5})(\d)/, '$1-$2')
        .replace(/(-\d{4})\d+?$/, '$1');
}

// Event Listeners Globais

// Fechar modal ao pressionar ESC
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

// Prevenir envio do formulário de contato e mostrar mensagem
document.addEventListener('DOMContentLoaded', function() {
    const formContato = document.getElementById('formContato');
    if (formContato) {
        formContato.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Mensagem enviada com sucesso! Entraremos em contato em breve.');
            fecharModal(null, 'modalContato');
            formContato.reset();
        });
    }
});

console.log('✅ Utils.js carregado com sucesso');

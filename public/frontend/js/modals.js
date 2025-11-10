// Funções compartilhadas de Modal
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
    document.getElementById('modalSobre').style.display = 'flex';
}

function abrirConfiguracoes(event) {
    event.preventDefault();
    document.getElementById('modalConfiguracoes').style.display = 'flex';
}

function abrirContato(event) {
    event.preventDefault();
    document.getElementById('modalContato').style.display = 'flex';
}

function fecharModal(event, modalId) {
    event.preventDefault();
    document.getElementById(modalId).style.display = 'none';
}

function salvarConfiguracoes() {
    alert('Configurações salvas com sucesso!');
    fecharModal(event, 'modalConfiguracoes');
}

// Fechar modal ao pressionar ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            if (modal.style.display === 'flex') {
                modal.style.display = 'none';
            }
        });
    }
});

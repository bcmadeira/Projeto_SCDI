// JavaScript para a tela de login
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    
    // Remover o preventDefault para permitir que o Laravel processe o login
    // O formulário será enviado normalmente para o backend
    
    // Adiciona efeitos visuais aos campos
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#28a745';
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.style.borderColor = '#e1e1e1';
            }
        });
    });
});
// JavaScript para a tela de login
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        // Validação básica
        if (!email || !password) {
            alert('Por favor, preencha todos os campos.');
            return;
        }
        
        // Verificar credenciais e redirecionar
        if (email === 'instituicao@gmail.com' && password === '123') {
            // Login como instituição
            localStorage.setItem('userType', 'instituicao');
            localStorage.setItem('userEmail', email);
            setTimeout(() => {
                window.location.href = 'dashboard.html';
            }, 500);
        } else if (email === 'doador@gmail.com' && password === '123') {
            // Login como doador
            localStorage.setItem('userType', 'doador');
            localStorage.setItem('userEmail', email);
            setTimeout(() => {
                window.location.href = 'doador-dashboard.html';
            }, 500);
        } else {
            alert('Email ou senha incorretos!');
        }
    });
    
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
// Dashboard - Otimizado
document.addEventListener('DOMContentLoaded', function() {
    function atualizarHora() {
        const agora = new Date();
        document.getElementById('ultimaAtualizacao').textContent = agora.toLocaleString('pt-BR', {
            day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit'
        });
    }
    
    function configurarGraficoCampanhas() {
        const ctx = document.getElementById('campanhasChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: 'Doações Recebidas',
                    data: [65, 78, 90, 81, 95, 105, 110, 125, 140, 135, 150, 160],
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }, {
                    label: 'Meta Mensal',
                    data: [100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100],
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    fill: false
                }]
            },
            options: { responsive: true, maintainAspectRatio: true, aspectRatio: 2, plugins: { legend: { display: true, position: 'top' } } }
        });
    }
    
    function configurarGraficoCategorias() {
        const ctx = document.getElementById('categoriasChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Alimentos', 'Roupas', 'Dinheiro', 'Medicamentos', 'Outros'],
                datasets: [{
                    data: [35, 25, 20, 15, 5],
                    backgroundColor: ['#28a745', '#007bff', '#ffc107', '#17a2b8', '#6c757d']
                }]
            },
            options: { responsive: true, maintainAspectRatio: true, aspectRatio: 1.2, plugins: { legend: { position: 'bottom' } } }
        });
    }
    
    function animarNumeros() {
        document.querySelectorAll('.stat-number').forEach(elemento => {
            const valorFinal = elemento.textContent;
            const valorNumerico = parseFloat(valorFinal.replace(/[^0-9,.]/g, '').replace(',', '.')) * 1000;
            let contador = 0;
            const incremento = valorNumerico / 50;
            
            const timer = setInterval(() => {
                contador += incremento;
                if (contador >= valorNumerico) {
                    contador = valorNumerico;
                    clearInterval(timer);
                }
                elemento.textContent = valorFinal.includes('R$') ? `R$ ${(contador / 1000).toFixed(1)}k` :
                                       valorFinal.includes(',') ? Math.floor(contador).toLocaleString('pt-BR') :
                                       Math.floor(contador);
            }, 50);
        });
    }
    
    window.abrirConfiguracoes = function() {
        document.getElementById('modalConfiguracoes').style.display = 'flex';
    };
    
    function adicionarInteratividadeCards() {
        document.querySelectorAll('.stat-card').forEach(card => {
            card.style.cursor = 'pointer';
            card.addEventListener('click', function() {
                const label = this.querySelector('.stat-label').textContent;
                const rotas = {
                    'Total de Doações': 'relatorio.html',
                    'Campanhas Ativas': 'minhas-campanhas.html',
                    'Valor Arrecadado': 'relatorio.html'
                };
                if (rotas[label]) window.location.href = rotas[label];
                else alert('Lista de doadores em desenvolvimento!');
            });
        });
    }
    
    function inicializar() {
        atualizarHora();
        configurarGraficoCampanhas();
        configurarGraficoCategorias();
        animarNumeros();
        adicionarInteratividadeCards();
    }
    
    setTimeout(inicializar, 100);
});

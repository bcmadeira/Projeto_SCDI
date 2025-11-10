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
        
        // Usar dados reais do banco se disponíveis
        let labels, valores;
        if (window.dadosMensais && window.dadosMensais.labels.length > 0) {
            labels = window.dadosMensais.labels;
            valores = window.dadosMensais.valores;
        } else {
            // Dados mock para quando não há dados
            labels = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
            valores = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        }
        
        // Calcular meta mensal (média dos valores ou valor máximo)
        const valorMaximo = Math.max(...valores);
        const metaMensal = valorMaximo > 0 ? valorMaximo * 1.2 : 5000; // 20% acima do máximo ou R$ 5.000
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doações Recebidas (R$)',
                    data: valores,
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }, {
                    label: 'Meta Mensal',
                    data: Array(labels.length).fill(metaMensal),
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    fill: false
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: true, 
                aspectRatio: 2, 
                plugins: { 
                    legend: { display: true, position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.dataset.label || '';
                                const value = context.parsed.y || 0;
                                return label + ': R$ ' + value.toFixed(2);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'R$ ' + value;
                            }
                        }
                    }
                }
            }
        });
    }
    
    function configurarGraficoCategorias() {
        const ctx = document.getElementById('categoriasChart').getContext('2d');
        
        // Usar dados reais do banco se disponíveis, senão usar dados mock
        let labels, valores;
        if (window.dadosCategorias && window.dadosCategorias.labels.length > 0) {
            labels = window.dadosCategorias.labels;
            valores = window.dadosCategorias.valores;
        } else {
            // Dados mock para quando não há doações
            labels = ['Sem dados'];
            valores = [1];
        }
        
        // Cores por tipo de doação
        const coresPorTipo = {
            'Dinheiro': '#28a745',
            'Alimentos': '#ffc107',
            'Roupas': '#007bff',
            'Medicamentos': '#17a2b8',
            'Outros': '#6c757d'
        };
        
        const cores = labels.map(label => coresPorTipo[label] || '#6c757d');
        
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: valores,
                    backgroundColor: cores
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: true, 
                aspectRatio: 1.2, 
                plugins: { 
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                return label + ': R$ ' + value.toFixed(2);
                            }
                        }
                    }
                } 
            }
        });
    }
    
    function animarNumeros() {
        document.querySelectorAll('.stat-number').forEach(elemento => {
            const valorOriginal = elemento.textContent.trim();
            let valorFinal;
            let formato;
            
            // Detectar o formato do número
            if (valorOriginal.includes('R$')) {
                // Formato monetário (ex: R$ 7.2k)
                formato = 'dinheiro';
                const valorTexto = valorOriginal.replace('R$', '').replace('k', '').trim();
                valorFinal = parseFloat(valorTexto.replace(',', '.'));
            } else {
                // Número normal (ex: 4, 1, 3)
                formato = 'numero';
                valorFinal = parseInt(valorOriginal);
            }
            
            let contador = 0;
            const incremento = valorFinal / 50;
            
            const timer = setInterval(() => {
                contador += incremento;
                if (contador >= valorFinal) {
                    contador = valorFinal;
                    clearInterval(timer);
                }
                
                if (formato === 'dinheiro') {
                    elemento.textContent = `R$ ${contador.toFixed(1)}k`;
                } else {
                    elemento.textContent = Math.floor(contador);
                }
            }, 20);
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

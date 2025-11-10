/**
 * Components Loader - SCDI
 * Carrega componentes reutilizáveis (navbar, modals) dinamicamente
 */

/**
 * Carrega um componente HTML e injeta no DOM
 * @param {string} componentPath - Caminho relativo do componente
 * @param {string} targetId - ID do elemento onde o componente será injetado
 * @returns {Promise<void>}
 */
async function loadComponent(componentPath, targetId) {
    try {
        const response = await fetch(componentPath);
        if (!response.ok) {
            throw new Error(`Erro ao carregar ${componentPath}: ${response.status}`);
        }
        const html = await response.text();
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            targetElement.innerHTML = html;
        } else {
            console.error(`Elemento com ID '${targetId}' não encontrado`);
        }
    } catch (error) {
        console.error('Erro ao carregar componente:', error);
    }
}

/**
 * Inicializa os componentes comuns baseado no tipo de usuário
 * @param {string} userType - 'instituicao' ou 'doador'
 */
async function initComponents(userType = 'instituicao') {
    // Carrega navbar apropriada
    const navbarPath = userType === 'doador' 
        ? '../components/navbar-doador.html' 
        : '../components/navbar-instituicao.html';
    
    await loadComponent(navbarPath, 'navbar-container');
    
    // Carrega modals comuns
    await loadComponent('../components/modals-common.html', 'modals-container');
    
    console.log(`✅ Componentes carregados para tipo: ${userType}`);
}

/**
 * Detecta automaticamente o tipo de usuário do localStorage
 * @returns {string} - 'instituicao' ou 'doador'
 */
function detectUserType() {
    const userType = localStorage.getItem('userType');
    
    // Se não há userType salvo, detecta pela URL
    if (!userType) {
        const currentPage = window.location.pathname;
        if (currentPage.includes('doador')) {
            return 'doador';
        }
        return 'instituicao';
    }
    
    return userType;
}

/**
 * Inicialização automática quando o DOM estiver pronto
 */
document.addEventListener('DOMContentLoaded', function() {
    // Verifica se os containers existem na página
    const hasNavbar = document.getElementById('navbar-container');
    const hasModals = document.getElementById('modals-container');
    
    if (hasNavbar || hasModals) {
        const userType = detectUserType();
        initComponents(userType);
    }
});

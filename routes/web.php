<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    InstituicaoController,
    DoadorController,
    CampanhaController,
    DoacaoController,
    HomeDoadorController,
    RelatorioController,
    Auth\DoadorAuthController
};

// Página inicial
Route::get('/', function () {
    return view('apresentacao');
})->name('home');
// Página de boas-vindas (cadastro rápido)
Route::get('/welcome', function () {
    return view('auth.cadastrar');
})->name('welcome');
Route::get('/cadastrar', function () {
    return view('auth.cadastrar');
})->name('cadastrar');

// ============================================
// ROTAS DE AUTENTICAÇÃO
// ============================================

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [InstituicaoController::class, 'login'])->name('login.post');

// ============================================
// ROTAS DE CADASTRO
// ============================================

// Doador
Route::get('/doador/cadastro', function () {
    return view('doador.cadastro');
})->name('doador.cadastro');

Route::post('/doador/cadastro', [DoadorController::class, 'store'])->name('doador.store');

// Instituição
Route::get('/instituicao/cadastro', function () {
    return view('instituicao.cadastro');
})->name('instituicao.cadastro');

Route::post('/instituicoes', [InstituicaoController::class, 'store'])->name('instituicoes.store');

// ============================================
// ROTAS DE CAMPANHAS
// ============================================
// Listagem e visualização (público/doador)
Route::get('/campanhas', [CampanhaController::class, 'index'])->name('campanhas.index');
// Criação e gerenciamento (instituições) - DEVE VIR ANTES DE {id}
Route::get('/campanhas/criar', [CampanhaController::class, 'create'])->name('campanhas.create');
Route::post('/campanhas', [CampanhaController::class, 'store'])->name('campanhas.store');
Route::get('/minhas-campanhas', [CampanhaController::class, 'minhas'])->name('campanhas.minhas');
// Visualização específica - DEVE VIR DEPOIS
Route::get('/campanhas/{id}', [CampanhaController::class, 'show'])->name('campanhas.show');

// ============================================
// ROTAS DE DOAÇÕES
// ============================================

Route::post('/doacoes', [DoacaoController::class, 'store'])->name('doacoes.store');
Route::get('/doador/minhas-doacoes', [DoacaoController::class, 'minhas'])->name('doador.minhas-doacoes');

// ============================================
// ROTAS DE DASHBOARDS
// ============================================

// Dashboard Instituição
Route::get('/dashboard', [App\Http\Controllers\InstituicaoController::class, 'dashboard'])->name('dashboard.instituicao');

// Perfil Instituição
Route::get('/instituicao/perfil', [InstituicaoController::class, 'perfil'])->name('instituicao.perfil');

// Dashboard Doador
Route::get('/doador/dashboard', [DoadorController::class, 'dashboard'])->name('dashboard.doador');

// Perfil Doador
Route::get('/doador/perfil', [DoadorController::class, 'perfil'])->name('doador.perfil');

// ============================================
// ROTAS DE RELATÓRIOS (Admin/Instituição)
// ============================================
// =====================================================================
// ROTAS DE AUTENTICAÇÃO DO DOADOR (PÚBLICAS)
// =====================================================================
Route::get('/login-doador', [DoadorAuthController::class, 'showLoginForm'])->name('login.doador');
Route::post('/login-doador', [DoadorAuthController::class, 'login'])->name('login.doador.submit');

Route::get('/cadastro-doador', [DoadorAuthController::class, 'showRegisterForm'])->name('cadastro.doador');
Route::post('/cadastro-doador', [DoadorAuthController::class, 'cadastrar'])->name('cadastro.doador.submit');

// Logout do Doador
Route::post('/logout-doador', [DoadorAuthController::class, 'logout'])->name('logout.doador');

// =====================================================================
// ROTAS VISÍVEIS SEM LOGIN (APENAS VISUALIZAÇÃO DE CAMPANHAS)
// =====================================================================
// (Já declaradas acima, não repetir)

// =====================================================================
// ROTAS QUE NECESSITAM DOADOR LOGADO (auth:doador)
// =====================================================================
Route::middleware('auth:doador')->group(function () {

    // Home do doador autenticado
    Route::get('/doador/home', [HomeDoadorController::class, 'index'])->name('doador.home');

    // Criar campanhas (se o doador/usuário puder criar)
    Route::get('/campanhas/criar', [CampanhaController::class, 'create'])->name('campanhas.create');
    Route::post('/campanhas', [CampanhaController::class, 'store'])->name('campanhas.store');

    // Criar Instituição
    Route::resource('instituicoes', InstituicaoController::class);

    // Doações
    Route::get('/campanhas/{id}/doar', [DoacaoController::class, 'create'])->name('doacoes.create');
    Route::post('/doacoes', [DoacaoController::class, 'store'])->name('doacoes.store');
});


// =====================================================================
// 🔒 ROTAS ADMINISTRATIVAS PARA RELATÓRIOS (PODEM SER OUTRO GUARD)
// =====================================================================
Route::prefix('adm')->name('adm.')->group(function () {
    Route::prefix('relatorios')->name('relatorios.')->group(function () {
        Route::get('/', [RelatorioController::class, 'index'])->name('index');
        Route::get('/filtrar', [RelatorioController::class, 'filtrar'])->name('filtrar');
        Route::get('/{id}', [RelatorioController::class, 'show'])->name('show');
        Route::get('/exportar/{id}', [RelatorioController::class, 'exportarPdf'])->name('exportar');
    });
});

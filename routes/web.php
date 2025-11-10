<?php

use App\Http\Controllers\Auth\DoadorAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    InstituicaoController,
    CampanhaController,
    DoacaoController,
    HomeDoadorController,
    RelatorioController
};

// Página inicial
Route::get('/', function () {
    return view('apresentacao');
})->name('home');

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
Route::get('/campanhas', [CampanhaController::class, 'index'])->name('campanhas.index');
Route::get('/campanhas/{id}', [CampanhaController::class, 'show'])->name('campanhas.show');

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

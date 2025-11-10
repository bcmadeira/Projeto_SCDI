<?php

use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\DoadorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampanhaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\DoacaoController;

// ============================================
// ROTAS PÚBLICAS
// ============================================

// Página inicial - Tela de apresentação
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

Route::prefix('Adm')->group(function () {
    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('adm.relatorios.index');
    Route::get('/relatorios/filtrar', [RelatorioController::class, 'filtrar'])->name('adm.relatorios.filtrar');
    Route::get('/relatorios/{id}', [RelatorioController::class, 'show'])->name('adm.relatorios.show');
    Route::get('/relatorios/exportar/{id}', [RelatorioController::class, 'exportarPdf'])->name('adm.relatorios.exportar');
});

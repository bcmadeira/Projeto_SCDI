<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    InstituicaoController,
    CampanhaController,
    DoacaoController,
    RelatorioController
};

// Página inicial
Route::get('/', function () {
    return view('apresentacao');
})->name('home');

// =============================================
// 🏛️ INSTITUIÇÕES
// =============================================
Route::resource('instituicoes', InstituicaoController::class)
    ->parameters(['instituicoes' => 'instituicao'])
    ->names([
        'index' => 'instituicoes.index',
        'create' => 'instituicoes.create',
        'store' => 'instituicoes.store',
        'edit' => 'instituicoes.edit',
        'update' => 'instituicoes.update',
        'destroy' => 'instituicoes.destroy',
        'show' => 'instituicoes.show',
    ]);

// =============================================
// 🎯 CAMPANHAS
// =============================================
Route::prefix('campanhas')->name('campanhas.')->group(function () {
    Route::get('/', [CampanhaController::class, 'index'])->name('index');
    Route::get('/criar', [CampanhaController::class, 'create'])->name('create');
    Route::post('/', [CampanhaController::class, 'store'])->name('store');
    Route::get('/{id}', [CampanhaController::class, 'show'])->name('show');

    // 🩵 Doar para campanha específica
    Route::get('/{id}/doar', [DoacaoController::class, 'create'])->name('doar');
});

// =============================================
// 💰 DOAÇÕES
// =============================================
Route::prefix('doacoes')->name('doacoes.')->group(function () {
    Route::post('/', [DoacaoController::class, 'store'])->name('store');
    Route::get('/', [DoacaoController::class, 'index'])->name('index'); // caso queira listar doações no futuro
});

// =============================================
// 🧾 RELATÓRIOS ADMINISTRATIVOS
// =============================================
Route::prefix('adm')->name('adm.')->group(function () {
    Route::prefix('relatorios')->name('relatorios.')->group(function () {
        Route::get('/', [RelatorioController::class, 'index'])->name('index');
        Route::get('/filtrar', [RelatorioController::class, 'filtrar'])->name('filtrar');
        Route::get('/{id}', [RelatorioController::class, 'show'])->name('show');
        Route::get('/exportar/{id}', [RelatorioController::class, 'exportarPdf'])->name('exportar');
    });
});

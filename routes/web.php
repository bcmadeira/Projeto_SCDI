<?php

use App\Http\Controllers\InstituicaoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampanhaController;
use App\Http\Controllers\RelatorioController;



Route::get('/', function () {
    return view('apresentacao');
});


Route::resource('instituicoes', InstituicaoController::class);


Route::get('/campanhas', [CampanhaController::class, 'index'])->name('campanhas.index');
Route::get('/campanhas/{id}', [CampanhaController::class, 'show'])->name('campanhas.show');

Route::get('/campanhas/criar', [CampanhaController::class, 'create'])->name('campanhas.create');
Route::post('/campanhas', [CampanhaController::class, 'store'])->name('campanhas.store');

// Rotas de Relatórios

Route::prefix('Adm')->group(function () {
    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('adm.relatorios.index');
    Route::get('/relatorios/filtrar', [RelatorioController::class, 'filtrar'])->name('adm.relatorios.filtrar');
    Route::get('/relatorios/{id}', [RelatorioController::class, 'show'])->name('adm.relatorios.show');
    Route::get('/relatorios/exportar/{id}', [RelatorioController::class, 'exportarPdf'])->name('adm.relatorios.exportar');
});

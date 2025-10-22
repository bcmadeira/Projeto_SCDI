<?php

use App\Http\Controllers\InstituicaoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampanhaController;


Route::get('/', function () {
    return view('apresentacao');
});

Route::get('/instituicoes', function () {
    return view('./Instituicoes/instituicoes');
});

Route::post('/instituicoes', [InstituicaoController::class, 'store'])->name('instituicoes.store');
Route::get('/campanhas', [CampanhaController::class, 'index'])->name('campanhas.index');
Route::get('/campanhas/{id}', [CampanhaController::class, 'show'])->name('campanhas.show');

Route::get('/campanhas/criar', [CampanhaController::class, 'create'])->name('campanhas.create');
Route::post('/campanhas', [CampanhaController::class, 'store'])->name('campanhas.store');

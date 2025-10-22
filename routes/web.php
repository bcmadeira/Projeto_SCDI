<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampanhaController;


Route::get('/', function () {
    return view('apresentacao');
});

// Rota para teste do header
Route::get('/teste', function () {
    return view('teste');
})->name('teste');

Route::get('/campanhas', [CampanhaController::class, 'index'])->name('campanhas.index');
Route::get('/campanhas/{id}', [CampanhaController::class, 'show'])->name('campanhas.show');

Route::get('/campanhas/criar', [CampanhaController::class, 'create'])->name('campanhas.create');
Route::post('/campanhas', [CampanhaController::class, 'store'])->name('campanhas.store');

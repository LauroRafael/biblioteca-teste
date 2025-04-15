<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\UserController;

/* Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/', function () {
    return redirect('/usuarios');
});

Route::resource('usuarios', UserController::class);
Route::resource('livros', LivroController::class);
Route::resource('emprestimos', controller: EmprestimoController::class)->except(['show']);

Route::post('/emprestimos/{emprestimo}/devolver', [EmprestimoController::class, 'marcarDevolvido'])->name('emprestimos.devolver');
Route::post('/emprestimos/{emprestimo}/atrasar', [EmprestimoController::class, 'marcarAtrasado'])->name('emprestimos.atrasar');
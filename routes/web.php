<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaController;

Route::get('/', function () {
    return view('welcome');
});

//Rota para a criação de novas matérias
Route::get('/materia/create', [MateriaController::class, 'create'])->name('materia.create');
Route::post('/materia/store', [MateriaController::class, 'store'])->name('materia.store');

//Rota para exibir todas as matérias
Route::get('/materia', [MateriaController::class,'index'])->name('materia.index');

//Rota que exibe o formulário de edição
Route::get('/materia/editar/{id}', [MateriaController::class, 'edit'])->name('materia.edit');

//Rota que atualiza os dados da matéria no banco
Route::put('/materias/{id}', [MateriaController::class, 'update'])->name('materia.update');

Route::delete('/materias/{id}', [MateriaController::class, 'destroy'])->name('materia.destroy');

Route::get('/professor', function () {
    return view('professor.index');
})->name('professor.home');
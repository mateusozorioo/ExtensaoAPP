<?php

use App\Http\Controllers\HackathonsDisponiveisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\TurmasController;
use App\Http\Controllers\SolicitacaoController;

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

// A 'Route::resource equivale a escrever todas as rotas de um CRUD manualmente (como eu escrevi acima):
Route::resource('hackathons-disponiveis', HackathonsDisponiveisController::class);

Route::get('/aluno', [HackathonsDisponiveisController::class, 'aluno'])->name('hackathons-disponiveis.aluno'); // Nova rota

Route::get('/turmas', [TurmasController::class, 'index'])->name('turmas.index');


// Rotas para solicitações de alunos
Route::prefix('alunos')->name('alunos.')->group(function () {
    // Outras rotas de aluno...
    
    // Rotas para solicitações - AGORA VAI FUNCIONAR!
    Route::get('/solicitacao', [SolicitacaoController::class, 'index'])->name('solicitacao.index');
    Route::post('/solicitacao', [SolicitacaoController::class, 'store'])->name('solicitacao.store');
});
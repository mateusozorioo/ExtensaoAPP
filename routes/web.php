    <?php

    use App\Http\Controllers\HackathonsDisponiveisController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\MateriaController;
    use App\Http\Controllers\MateriaAlunoController;
    use App\Http\Controllers\TurmasController;
    use App\Http\Controllers\SolicitacaoController;
    use App\Http\Controllers\AnulacaoController;
    use Illuminate\Support\Facades\Auth;
    use Laravel\Socialite\Facades\Socialite;
    use App\Http\Controllers\Auth\GoogleAuthController;
    use  App\Models\User;

    Route::middleware(['auth.custom'])->group(function () {
        
        // Rota de logout
        Route::post('/logout', function () {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/login');
        })->name('logout');

        Route::get('/', function () {
            return view('auth.login');
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

        Route::get('/hackathon-imagem/{id}', [HackathonsDisponiveisController::class, 'servirImagem'])
            ->name('hackathons-disponiveis.imagem');

            // A 'Route::resource equivale a escrever todas as rotas de um CRUD manualmente (como eu escrevi acima):
        Route::resource('hackathons-disponiveis', HackathonsDisponiveisController::class);

        Route::get('/aluno', [HackathonsDisponiveisController::class, 'aluno'])->name('hackathons-disponiveis.aluno'); // Nova rota

        Route::get('/turmas', [TurmasController::class, 'index'])->name('turmas.index');

        // Rotas para gerenciamento de solicitações (Professor)
        Route::prefix('solicitacoes')->name('solicitacoes.')->group(function () {
            // Rota para listar solicitações pendentes
            Route::get('/', [SolicitacaoController::class, 'indexProfessor'])->name('index');
            
            // Rota para aceitar solicitação
            Route::patch('/{id}/aceitar', [SolicitacaoController::class, 'aceitar'])->name('aceitar');
            
            // Rota para recusar solicitação
            Route::patch('/{id}/recusar', [SolicitacaoController::class, 'recusar'])->name('recusar');
        });

        // Rotas para solicitações de alunos
        Route::prefix('alunos')->name('alunos.')->group(function () {

            // Rotas para solicitações 
            Route::get('/solicitacao', [SolicitacaoController::class, 'index'])->name('solicitacao.index');
            Route::post('/solicitacao', [SolicitacaoController::class, 'store'])->name('solicitacao.store');
            // Rota para confirmação de envio de solicitação:
            Route::get('/solicitacao/{id}/confirmacao', [SolicitacaoController::class, 'confirmacao'])->name('solicitacao.confirmacao');
            
            //ROTAS PARA A INSCRIÇÃO DE ALUNOS EM MATÉRIA
            Route::get('/materia', [MateriaAlunoController::class, 'index'])->name('materia.index');
            Route::post('/materia', [MateriaAlunoController::class, 'store'])->name('materia.store');
            Route::get('/materia/edit', [MateriaAlunoController::class, 'edit'])->name('materia.edit'); 
            Route::post('/materia/update', [MateriaAlunoController::class, 'update'])->name('materia.update');
            Route::delete('/materia/delete', [MateriaAlunoController::class, 'destroy'])->name('materia.destroy');

            // Rota AJAX para buscar bimestres por matéria
            Route::get('/materia/bimestres', [MateriaAlunoController::class, 'getBimestresPorMateria'])->name('materia.bimestres');

            Route::get('/hackathons-disponiveis', [HackathonsDisponiveisController::class, 'indexAlunos'])->name('hackathons');

            // Rotas para anulação de matéria
            Route::get('/anular-materia', [AnulacaoController::class, 'index'])->name('anulacao.index');
            Route::post('/anular-materia/anular', [AnulacaoController::class, 'anular'])->name('anulacao.anular');

            Route::get('/acompanhar-solicitacoes', [SolicitacaoController::class, 'acompanharSolicitacoes'])->name('acompanhar-solicitacoes.index');
        });

        Route::get('/alunos', function () {
            return view('alunos.index');
        })->name('alunos.home');

    });

    // Rota da página de login
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login'); 

    // Rotas de autenticação Google
    Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

    // Rota de acesso proibido (para emails não autorizados)
    Route::get('/proibido', function () {
        return view('proibido.index');
    })->name('proibido.index');

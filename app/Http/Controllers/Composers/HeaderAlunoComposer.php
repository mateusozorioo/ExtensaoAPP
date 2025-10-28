<?php

namespace App\Http\Controllers\Composers;

use Illuminate\View\View;
use App\Models\Aluno;
use Illuminate\Support\Facades\Auth;

class HeaderAlunoComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = Auth::user();
        
        // Verifica se o usuário está autenticado
        if (!$user) {
            $view->with([
                'nomeAluno' => 'Visitante',
                'creditosAluno' => 0,
                'emailAluno' => '',
                'cursoAluno' => ''
            ]);
            return;
        }
        
        $aluno = $user->aluno;
        
        // Se encontrou o aluno, passa os dados
        if ($aluno) {
            $view->with([
                'nomeAluno' => $aluno->nome,
                'creditosAluno' => $aluno->creditos_aluno,
                'emailAluno' => $aluno->email,
                'cursoAluno' => $aluno->curso ?? 'Não informado'
            ]);
        } else {
            // Valores padrão caso não encontre o aluno
            $view->with([
                'nomeAluno' => 'Aluno não encontrado',
                'creditosAluno' => 0,
                'emailAluno' => $user->email ?? '',
                'cursoAluno' => ''
            ]);
        }
    }
}
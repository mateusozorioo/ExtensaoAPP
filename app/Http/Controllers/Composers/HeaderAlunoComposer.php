<?php

namespace App\Http\Controllers\Composers;

use Illuminate\View\View;
use App\Models\Aluno;

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
        // Por enquanto, buscando o aluno com ID = 1
        // Futuramente você pode pegar do usuário logado
        $aluno = Aluno::find(1);
        
        if ($aluno) {
            $view->with([
                'nomeAluno' => $aluno->nome,
                'creditosAluno' => $aluno->creditos_aluno,
                'emailAluno' => $aluno->email,
                'cursoAluno' => $aluno->curso
            ]);
        } else {
            // Valores padrão caso não encontre o aluno
            $view->with([
                'nomeAluno' => 'Aluno não encontrado',
                'creditosAluno' => 0,
                'emailAluno' => '',
                'cursoAluno' => ''
            ]);
        }
    }
}
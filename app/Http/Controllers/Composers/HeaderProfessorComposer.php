<?php

namespace App\Http\Controllers\Composers;

use Illuminate\View\View;
use App\Models\Professor;
use Illuminate\Support\Facades\Auth;

class HeaderProfessorComposer
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
                'nomeProfessor' => 'Visitante',
                'emailProfessor' => ''
            ]);
            return;
        }
        
        $professor = $user->professor;
        
        // Se encontrou o professor, passa os dados
        if ($professor) {
            $view->with([
                'nomeProfessor' => $professor->nome,
                'emailProfessor' => $professor->email
            ]);
        } else {
            // Valores padrão caso não encontre o professor
            $view->with([
                'nomeProfessor' => 'Professor não encontrado',
                'emailProfessor' => $user->email ?? ''
            ]);
        }
    }
}
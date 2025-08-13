<?php

namespace App\Http\Controllers;

use App\Models\Aluno; //importa o Model Aluno
use App\Models\Materia; //importa o Model Matéria
use Illuminate\Http\Request;

class TurmasController extends Controller // Mudança aqui
{
    /**
     * Método para exibir a página de consulta de alunos por matéria
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Busca todas as matérias disponíveis para popular o select
        $materias = Materia::orderBy('nome_materia', 'asc')->get();
        
        // Inicializa as variáveis
        $alunos = collect(); // Collection vazia
        $materiaSelecionada = null;
        
        // Verifica se foi selecionada uma matéria
        if ($request->has('materia_id') && $request->materia_id != '') {
            
            // Busca a matéria selecionada para exibir suas informações
            $materiaSelecionada = Materia::find($request->materia_id);
            
            // Verifica se a matéria existe
            if ($materiaSelecionada) {
                // Busca todos os alunos que estão inscritos na matéria selecionada
                // WHERE materia_id = $request->materia_id
                $alunos = Aluno::where('materia_id', $request->materia_id)
                              ->orderBy('nome', 'asc') // Ordena por nome do aluno
                              ->get();
            } else {
                // Se a matéria não existe, redireciona com mensagem de erro
                return redirect()->route('turmas.index')
                                ->with('error', 'Matéria não encontrada.');
            }
        }
        
        // Retorna a view com os dados necessários
        return view('turmas.index', [
            'materias' => $materias,
            'alunos' => $alunos,
            'materiaSelecionada' => $materiaSelecionada
        ]);
    }
    
    // Outros métodos do controller (create, store, show, edit, update, destroy)...
}
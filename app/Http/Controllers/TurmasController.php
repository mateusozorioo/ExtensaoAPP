<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurmasController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $professor = $user->professor;
        
        if (!$professor) {
            return redirect()->back()
                ->with('error', 'Professor não encontrado.');
        }
        
        $materias = Materia::where('professor_id', $professor->professor_id)
                          ->orderBy('nome_materia', 'asc')
                          ->get();
        
        $alunos = collect();
        $materiaSelecionada = null;
        
        if ($request->has('materia_id') && $request->materia_id != '') {
            
            $materiaSelecionada = Materia::where('materia_id', $request->materia_id)
                                        ->where('professor_id', $professor->professor_id)
                                        ->first();
            
            if ($materiaSelecionada) {
                $alunos = Aluno::where('materia_id', $request->materia_id)
                              ->orderBy('nome', 'asc')
                              ->get();
            } else {
                return redirect()->route('turmas.index')
                                ->with('error', 'Matéria não encontrada ou você não tem permissão para acessá-la.');
            }
        }
        
        return view('turmas.index', [
            'materias' => $materias,
            'alunos' => $alunos,
            'materiaSelecionada' => $materiaSelecionada
        ]);
    }
}
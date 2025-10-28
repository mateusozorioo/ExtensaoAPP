<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Materia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AnulacaoController extends Controller
{
    /**
     * Exibe a tela de anulação de matéria
     */
    public function index()
    {
        $user = Auth::user();

        $aluno = $user->aluno;

        if (!$aluno) {
            return redirect()->back()->with('error', 'Aluno não encontrado.');
        }
        
        if (!$aluno) {
            abort(404, 'Aluno não encontrado');
        }

        return view('alunos.anular-materia.index', compact('aluno'));
    }

    /**
     * Processa a anulação da matéria
     */
    public function anular(Request $request)
    {
        try {
            // Para este exemplo, vou usar o aluno com ID 1
            // Em um sistema real, você pegaria o ID do aluno autenticado
            $user = Auth::user();

            $aluno = $user->aluno;

            if (!$aluno) {
                return redirect()->back()->with('error', 'Aluno não encontrado.');
            }
            
            if (!$aluno) {
                return response()->json(['success' => false, 'message' => 'Aluno não encontrado'], 404);
            }
            
            // Verifica se o aluno tem uma matéria cadastrada
            if (!$aluno->materia_id) {
                return response()->json(['success' => false, 'message' => 'Nenhuma matéria encontrada para anular']);
            }
            


            // Verifica se o aluno tem créditos suficientes
            if ($aluno->creditos_aluno <= 0) {
                return response()->json([
                    'success' => false, 
                    'insufficient_credits' => true,
                    'message' => 'Você deve possuir ao menos <b>1 crédito</b> para substituir uma matéria. Clique abaixo para conseguir um crédito validando um hackathon feito por você!'
                ]);
            }

            // Busca a matéria para pegar o nome
            $materia = Materia::find($aluno->materia_id);
            $nomeMateria = $materia ? $materia->nome_materia : 'Matéria';

            // Inicia uma transação para garantir consistência
            DB::beginTransaction();

            try {
                // Subtrai 1 crédito
                $aluno->creditos_aluno -= 1;

                // Marca que o aluno já anulou uma matéria este bimestre
                $aluno->materia_anulada = 1;
                
                // Remove a matéria (anula)
                // $aluno->materia_id = null;
                
                // Salva as alterações
                $aluno->save();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => "Parabéns, você acaba de anular a matéria <strong>{$nomeMateria}</strong> durante o bimestre todo!",
                    'creditos_restantes' => $aluno->creditos_aluno
                ]);

            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erro interno do sistema: ' . $e->getMessage()], 500);
        }
    }
}
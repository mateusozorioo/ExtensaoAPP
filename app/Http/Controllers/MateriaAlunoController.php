<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Aluno;
use Illuminate\Support\Facades\Auth;

class MateriaAlunoController extends Controller
{
    // Exibe a tela de inscrição em matéria para o aluno
    public function index()
    {
        $user = Auth::user();
        
        $aluno = $user->aluno;

        if (!$aluno) {
            return redirect()->back()->with('error', 'Aluno não encontrado.');
        }
        
        // Verifica se o aluno existe no banco de dados
        if (!$aluno) {
            // Se não encontrou o aluno, redireciona com mensagem de erro
            return redirect()->back()->with('error', 'Aluno não encontrado.');
        }
        
        // Verifica se o aluno já possui uma matéria associada (campo materia_id preenchido)
        if ($aluno->materia_id) {
            // Aluno já inscrito - busca os dados completos da matéria associada
            $materia = Materia::find($aluno->materia_id);
            // Retorna a view específica para aluno já inscrito, passando os dados
            return view('alunos.materia.inscrito', compact('aluno', 'materia'));
        }
        
        // Se chegou até aqui, o aluno NÃO está inscrito em nenhuma matéria
        // Busca todas as matérias disponíveis, ordenadas alfabeticamente por nome
        $materias = Materia::orderBy('nome_materia', 'asc')->get();
        
        // Extrai apenas os nomes únicos das matérias para popular o dropdown
        // pluck() pega apenas o campo especificado, unique() remove duplicatas, values() reindexia
        $nomes_materias = $materias->pluck('nome_materia')->unique()->values();
        
        // Extrai apenas os bimestres únicos das matérias para popular o dropdown
        $bimestres = $materias->pluck('bimestre_cubo')->unique()->values();
        
        // Retorna a view de inscrição, passando os dados necessários para os dropdowns
        return view('alunos.materia.index', compact('nomes_materias', 'bimestres', 'materias'));
    }
    
    // Processa a inscrição do aluno na matéria (quando o formulário é enviado)
    public function store(Request $request)
    {
        // Valida os dados enviados pelo formulário - ambos campos são obrigatórios
        $request->validate([
            'nome_materia' => 'required|string',
            'bimestre_cubo' => 'required|string',
        ]);
        
        $user = Auth::user();
        
        $aluno = $user->aluno;

        if (!$aluno) {
            return redirect()->back()->with('error', 'Aluno não encontrado.');
        }
        
        // Busca a matéria específica que tem EXATAMENTE o nome E o bimestre selecionados
        // Isso garante que a combinação matéria+bimestre seja válida
        $materia = Materia::where('nome_materia', $request->nome_materia)
                         ->where('bimestre_cubo', $request->bimestre_cubo)
                         ->first(); // first() retorna o primeiro resultado ou null
        
        // Verifica se encontrou alguma matéria com essa combinação
        if (!$materia) {
            // Não existe matéria com essa combinação - retorna erro
            return redirect()->back() // Volta para a página anterior
                           ->withInput() // Mantém os dados preenchidos no formulário
                           ->with('error', 'A matéria e o bimestre devem condizer um com o outro.');
        }
        
        // Se chegou até aqui, a combinação é válida
        
        // Associa a matéria encontrada ao aluno (cria a inscrição)
        $aluno->materia_id = $materia->materia_id;
        
        // Salva as alterações no banco de dados
        $aluno->save();
        
        // Redireciona para a página principal com mensagem de sucesso
        return redirect()->route('alunos.materia.index')->with('success', 'Inscrição realizada com sucesso!');
    }
    
    // MÉTODO ATUALIZADO: Exibe a tela de edição/alteração de matéria
    public function edit()
    {
        $user = Auth::user();
        
        $aluno = $user->aluno;

        if (!$aluno) {
            return redirect()->back()->with('error', 'Aluno não encontrado.');
        }
        
        if (!$aluno) {
            return redirect()->back()->with('error', 'Aluno não encontrado.');
        }
        
        // Verifica se o aluno está inscrito em alguma matéria
        if (!$aluno->materia_id) {
            // Se não está inscrito, redireciona para a tela de inscrição
            return redirect()->route('alunos.materia.index')->with('error', 'Você não está inscrito em nenhuma matéria.');
        }
        
        // NOVA VERIFICAÇÃO: Verifica se a matéria foi anulada
        if ($aluno->materia_anulada == 1) {
            // Se a matéria foi anulada, redireciona para a tela de inscrito com mensagem de erro
            return redirect()->route('alunos.materia.index')->with('error', 'Não é possível alterar a matéria pois ela foi anulada durante o bimestre.');
        }
        
        // Busca a matéria atual do aluno
        $materiaAtual = Materia::find($aluno->materia_id);
        
        if (!$materiaAtual) {
            return redirect()->route('alunos.materia.index')->with('error', 'Matéria não encontrada.');
        }
        
        // Busca todas as matérias disponíveis para os dropdowns
        $materias = Materia::orderBy('nome_materia', 'asc')->get();
        
        // Separa nomes únicos e bimestres únicos para os dropdowns
        $nomes_materias = $materias->pluck('nome_materia')->unique()->values();
        $bimestres = $materias->pluck('bimestre_cubo')->unique()->values();
        
        return view('alunos.materia.edit', compact('nomes_materias', 'bimestres', 'materias', 'materiaAtual'));
    }
    
    // MÉTODO ATUALIZADO: Processa a alteração da matéria do aluno
    public function update(Request $request)
    {
        $request->validate([
            'nome_materia' => 'required|string',
            'bimestre_cubo' => 'required|string',
        ]);
        
        $user = Auth::user();

        $aluno = $user->aluno;

        if (!$aluno) {
            return redirect()->back()->with('error', 'Aluno não encontrado.');
        }
        
        // NOVA VERIFICAÇÃO: Verifica se a matéria foi anulada
        if ($aluno && $aluno->materia_anulada == 1) {
            return redirect()->back()->with('error', 'Não é possível alterar a matéria pois ela foi anulada durante o bimestre.');
        }
        
        // Busca a matéria que tem o nome E o bimestre selecionados
        $materia = Materia::where('nome_materia', $request->nome_materia)
                         ->where('bimestre_cubo', $request->bimestre_cubo)
                         ->first();
        
        if (!$materia) {
            // Não existe matéria com essa combinação
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'A matéria e o bimestre devem condizer um com o outro.');
        }
        
        // Atualiza o aluno com a nova materia_id
        $aluno->materia_id = $materia->materia_id;
        $aluno->save();
        
        return redirect()->route('alunos.materia.index')->with('success', 'Matéria alterada com sucesso!');
    }
    
    // Método AJAX para buscar bimestres baseados na matéria selecionada
    public function getBimestresPorMateria(Request $request)
    {
        $nomeMateria = $request->nome_materia;
        
        $bimestres = Materia::where('nome_materia', $nomeMateria)
                           ->pluck('bimestre_cubo')
                           ->unique()
                           ->values();
        
        return response()->json($bimestres);
    }
    
    // Método para remover o aluno da matéria (limpar materia_id)
    public function destroy()
    {
        $user = Auth::user();

        $aluno = $user->aluno;

        if (!$aluno) {
            return redirect()->back()->with('error', 'Aluno não encontrado.');
        }
        
        // Verifica se o aluno está inscrito em alguma matéria
        if (!$aluno->materia_id) {
            return redirect()->route('alunos.materia.index')->with('error', 'Você não está inscrito em nenhuma matéria.');
        }
        
        // Remove a associação com a matéria (define como null)
        $aluno->materia_id = null;
        
        // Salva a alteração no banco de dados
        $aluno->save();
        
        // Redireciona para a página principal com mensagem de sucesso
        return redirect()->route('alunos.materia.index')->with('success', 'Você saiu da matéria com sucesso!');
    }
}
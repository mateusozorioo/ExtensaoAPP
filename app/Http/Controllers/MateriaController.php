<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia; // Importa o model Materia
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
{
    //Método que exibe a lista de matérias (READ)
    public function index()
    {
        // Pega o professor autenticado
        $user = Auth::user();
        $professor = $user->professor;

        if (!$professor) {
            return redirect()->back()->with('error', 'Professor não encontrado.');
        }

        // Busca apenas as matérias deste professor
        $materias = Materia::where('professor_id', $professor->professor_id)
            ->orderBy('materia_id', 'asc')
            ->get();

        //Retorna a view passando os dados ($materias) para que a view possa usá-los
        return view('materia.index', compact('materias')); //= ('materia.index', ['materias' => $materias])
    }


    //Método que exibe o formulário para criar novas matérias (CREATE)
    public function create()
    {
        // Isso carrega a view resources/views/materia/create.blade.php
        return view('materia.create');
    }


    // Método que recebe os dados do formulário e salva no banco
    public function store(Request $request) // o 'Request' representa tudo que foi enviado na requisição HTTP
    {
        // Validação simples dos campos do formulário
        $request->validate([
            'nome_materia' => 'required|string|max:255',
            'bimestre_cubo' => 'required|string|max:2',
        ]);

        // Criação do novo registro do banco usando o Eloquent (geração do SQL)
        // Pega o professor autenticado
        $user = Auth::user();
        $professor = $user->professor;

        if (!$professor) {
            return redirect()->back()->with('error', 'Professor não encontrado.');
        }

        Materia::create([
            'nome_materia' => $request->nome_materia,
            'bimestre_cubo' => $request->bimestre_cubo,
            'professor_id' => $professor->professor_id, // ← ADICIONAR
        ]);

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('materia.index')->with('success', 'Matéria cadastrada com sucesso!');
    }

    public function edit($id)
    {
        // Pega o professor autenticado
        $user = Auth::user();
        $professor = $user->professor;

        if (!$professor) {
            return redirect()->back()->with('error', 'Professor não encontrado.');
        }

        // Busca a matéria e verifica se pertence ao professor
        $materia = Materia::where('materia_id', $id)
            ->where('professor_id', $professor->professor_id)
            ->firstOrFail();

        //Envia os dados para a view 'materia.edit'
        return view('materia.edit', compact('materia'));//= ('materia.edit', ['materias' => $materias])
    }

    //Atualiza a matéria no banco
    public function update(Request $request, $id)//O 'Request' representa tudo que foi enviado na requisição HTTP
    {
        //Valida os campos
        $request->validate([
            'nome_materia' => 'required|string|max:255',
            'bimestre_cubo' => 'required|string|max:2',
        ]);

        // Pega o professor autenticado
        $user = Auth::user();
        $professor = $user->professor;

        if (!$professor) {
            return redirect()->back()->with('error', 'Professor não encontrado.');
        }

        // Busca a matéria e verifica se pertence ao professor
        $materia = Materia::where('materia_id', $id)
            ->where('professor_id', $professor->professor_id)
            ->firstOrFail();

        //atualiza os dados e salva direto, sem ter que usar um save()
        $materia->update([
            'nome_materia' => $request->nome_materia,
            'bimestre_cubo' => $request->bimestre_cubo,
        ]);

        //Redireciona para a tela principal com uma mensagem de sucesso
        return redirect()->route('materia.index')->with('success', 'Matéria atualizada com sucesso!');
    }

    //Remove a matéria no banco
    public function destroy($id)
    {
        // Pega o professor autenticado
        $user = Auth::user();
        $professor = $user->professor;

        if (!$professor) {
            return redirect()->back()->with('error', 'Professor não encontrado.');
        }

        // Busca a matéria e verifica se pertence ao professor
        $materia = Materia::where('materia_id', $id)
            ->where('professor_id', $professor->professor_id)
            ->firstOrFail();

        //Exclui a matéria
        $materia->delete();

        //Redireciona com uma mensagem de sucesso
        return redirect()->route('materia.index')->with('success', 'Matéria excluída com sucesso!');
    }
}
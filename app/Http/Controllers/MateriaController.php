<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia; // Importa o model Materia

class MateriaController extends Controller
{
    //Método que exibe a lista de matérias (READ)
    public function index()
    {
        //Recupera todas as matérias do banco
        $materias = Materia::all();

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
            'bimestre_cubo' => 'required|string|max:100',
        ]);

        // Criação do novo registro do banco usando o Eloquent (geração do SQL)
        // (Criação da matéria com os dados vindos do formulário)
        Materia::create([
            'nome_materia' => $request->nome_materia,
            'bimestre_cubo' => $request->bimestre_cubo,
        ]);

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('materia.index')->with('success', 'Matéria cadastrada com sucesso!');
    }

    public function edit($id)
    {
        //Busca a matéria pelo id
        $materia = Materia::findOrFail($id);

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

        //Encontra a matéria 
        $materia = Materia::findOrFail($id);

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
        // Encontra a matéria pelo id
        $materia = Materia::findorFail($id);

        //Exclui a matéria
        $materia->delete();

        //Redireciona com uma mensagem de sucesso
        return redirect()->route('materia.index')->with('sucess', 'Matéria excluída com sucesso!');
    }
}
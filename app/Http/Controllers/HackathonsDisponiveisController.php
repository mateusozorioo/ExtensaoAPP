<?php

namespace App\Http\Controllers;

use App\Models\HackathonDisponivel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HackathonsDisponiveisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function aluno()
    {
        // Buscar todos os hackathons disponíveis
        //$hackathons = HackathonsDisponivel::orderBy('created_at', 'desc')->get();
        $hackathons = HackathonDisponivel::all();
        
        // Debug: Verificar se está retornando dados
        // dd($hackathons); // Descomente esta linha para debug
        
        return view('hackathons_disponiveis.aluno', compact('hackathons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hackathons_disponiveis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados recebidos do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'link' => 'required|url|max:500',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ], [
            'nome.required' => 'O nome do hackathon é obrigatório.',
            'nome.max' => 'O nome do hackathon não pode ter mais de 255 caracteres.',
            'link.required' => 'O link de inscrição é obrigatório.',
            'link.url' => 'O link deve ser uma URL válida.',
            'link.max' => 'O link não pode ter mais de 500 caracteres.',
            'imagem.required' => 'A imagem do hackathon é obrigatória.',
            'imagem.image' => 'O arquivo deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'imagem.max' => 'A imagem não pode ser maior que 2MB.',
        ]);

        // Processar o upload da imagem
        $imagemPath = null;
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            
            // Gera um nome único para a imagem
            $imagemNome = time() . '_' . uniqid() . '.' . $imagem->getClientOriginalExtension();
            
            // Cria o diretório se não existir
            $uploadPath = public_path('uploads/hackathons');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Move a imagem para o diretório public/uploads/hackathons
            $imagem->move($uploadPath, $imagemNome);
            
            // Salva apenas o caminho relativo no banco
            $imagemPath = 'uploads/hackathons/' . $imagemNome;
        }

        try {
            // Criar o novo hackathon no banco de dados
            $hackathon = HackathonDisponivel::create([
                'hackathon_nome' => $validatedData['nome'],
                'hackathon_link' => $validatedData['link'],
                'hackathon_imagem' => $imagemPath,
            ]);

            // Redirecionar com mensagem de sucesso
            return redirect()->route('hackathons-disponiveis.index')
                            ->with('success', 'Hackathon "' . $hackathon->hackathon_nome . '" criado com sucesso!');
                            
        } catch (\Exception $e) {
            // Se der erro, apagar a imagem que foi salva
            if ($imagemPath && file_exists(public_path($imagemPath))) {
                unlink(public_path($imagemPath));
            }
            
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Erro ao criar hackathon: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hackathon = HackathonDisponivel::findOrFail($id);
        return view('hackathons_disponiveis.show', compact('hackathon'));
    }

/**
     * Tela de edição com todos os hackathons
     */
    public function index()
    {
        $hackathons = HackathonDisponivel::all();
        return view('hackathons_disponiveis.index', compact('hackathons'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hackathon = HackathonDisponivel::findOrFail($id);
        return view('hackathons_disponiveis.edit', compact('hackathon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hackathon = HackathonDisponivel::findOrFail($id);
        
        // Validação dos dados
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'link' => 'required|url|max:500',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nome.required' => 'O nome do hackathon é obrigatório.',
            'nome.max' => 'O nome do hackathon não pode ter mais de 255 caracteres.',
            'link.required' => 'O link de inscrição é obrigatório.',
            'link.url' => 'O link deve ser uma URL válida.',
            'link.max' => 'O link não pode ter mais de 500 caracteres.',
            'imagem.image' => 'O arquivo deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'imagem.max' => 'A imagem não pode ser maior que 2MB.',
        ]);

        $imagemPath = $hackathon->hackathon_imagem;

        // Se uma nova imagem foi enviada
        if ($request->hasFile('imagem')) {
            // Apagar a imagem antiga
            if ($imagemPath && file_exists(public_path($imagemPath))) {
                unlink(public_path($imagemPath));
            }

            $imagem = $request->file('imagem');
            $imagemNome = time() . '_' . uniqid() . '.' . $imagem->getClientOriginalExtension();
            
            $uploadPath = public_path('uploads/hackathons');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $imagem->move($uploadPath, $imagemNome);
            $imagemPath = 'uploads/hackathons/' . $imagemNome;
        }

        try {
            // Atualizar o hackathon
            $hackathon->update([
                'hackathon_nome' => $validatedData['nome'],
                'hackathon_link' => $validatedData['link'],
                'hackathon_imagem' => $imagemPath,
            ]);

            return redirect()->route('hackathons-disponiveis.index')
                            ->with('success', 'Hackathon "' . $hackathon->hackathon_nome . '" atualizado com sucesso!');
                            
        } catch (\Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Erro ao atualizar hackathon: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $hackathon = HackathonDisponivel::findOrFail($id);
            
            // Remove a imagem do servidor
            if ($hackathon->hackathon_imagem && file_exists(public_path($hackathon->hackathon_imagem))) {
                unlink(public_path($hackathon->hackathon_imagem));
            }
            
            // Remove do banco
            $nomeHackathon = $hackathon->hackathon_nome;
            $hackathon->delete();

            return redirect()->route('hackathons-disponiveis.index')
                            ->with('success', 'Hackathon "' . $nomeHackathon . '" excluído com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Erro ao excluir hackathon: ' . $e->getMessage());
        }   
    }
}   
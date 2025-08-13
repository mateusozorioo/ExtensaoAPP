<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitacao;
use App\Models\Aluno;
use App\Models\Materia;
use App\Models\HackathonDisponivel; // ✅ CORRIGIDO: singular
use Illuminate\Support\Facades\Storage;

class SolicitacaoController extends Controller
{
    /**
     * Exibe a tela de solicitação para alunos
     */
    public function index()
    {
        // ✅ CORRIGIDO: usando o nome correto do model
        $hackathons = HackathonDisponivel::all();
        
        return view('alunos.solicitacao.index', compact('hackathons'));
    }

    /**
     * Processa e armazena a solicitação no banco de dados
     */
    public function store(Request $request)
    {
        // ✅ CORRIGIDO: usando os nomes corretos dos campos
        $validated = $request->validate([
            'hackathons_disponiveis_id' => 'required|exists:hackathons_disponiveis,hackathons_disponiveis_id',
            'metodo_validacao' => 'required|in:Formulário,Imagem,Certificado',
            'arquivo_prova' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'aluno_id' => 'required|exists:aluno,aluno_id'
        ], [
            'hackathons_disponiveis_id.required' => 'Por favor, selecione um hackathon.',
            'hackathons_disponiveis_id.exists' => 'Hackathon selecionado não é válido.',
            'metodo_validacao.required' => 'Por favor, selecione um método de validação.',
            'metodo_validacao.in' => 'Método de validação deve ser: Formulário, Imagem ou Certificado.',
            'arquivo_prova.required' => 'Por favor, anexe um arquivo de comprovação.',
            'arquivo_prova.mimes' => 'Arquivo deve ser: PDF, JPG, PNG, DOC ou DOCX.',
            'arquivo_prova.max' => 'Arquivo muito grande. Tamanho máximo: 10MB.',
            'aluno_id.required' => 'ID do aluno é obrigatório.',
            'aluno_id.exists' => 'Aluno não encontrado.'
        ]);

        try {
            // Upload do arquivo
            $nomeArquivo = time() . '_' . $request->file('arquivo_prova')->getClientOriginalName();
            $caminhoArquivo = $request->file('arquivo_prova')->storeAs(
                'solicitacoes', 
                $nomeArquivo, 
                'public'
            );

            // ✅ CORRIGIDO: usando os nomes corretos dos campos
            $solicitacao = new Solicitacao();
            $solicitacao->hackathons_disponiveis_id = $validated['hackathons_disponiveis_id']; // ✅ CORRIGIDO
            $solicitacao->arquivo_prova = $caminhoArquivo;
            $solicitacao->aluno_id = $validated['aluno_id'];
            $solicitacao->data_solicitacao = now();
            $solicitacao->status_solicitacao = 'Pendente';
            
            $solicitacao->save();

            return redirect()->route('aluno.solicitacao.index')
                           ->with('success', 'Solicitação enviada com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Erro ao enviar solicitação. Tente novamente.')
                           ->withInput();
        }
    }
}
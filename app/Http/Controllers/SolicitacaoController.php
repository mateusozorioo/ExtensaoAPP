<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitacao;
use App\Models\Aluno;
use App\Models\Materia;
use App\Models\HackathonDisponivel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // ← Linha para que Transações possam ser feitas (ex: linha 133)
use Illuminate\Support\Facades\Auth;

class SolicitacaoController extends Controller
{
    /**
     * Exibe a tela de solicitação para alunos
     */
    public function index()
    {
        // Busca hackathons disponíveis dos últimos 3 meses
        $hackathons = HackathonDisponivel::where('created_at', '>=', now()->subMonths(3))->get();
        return view('alunos.solicitacao.index', compact('hackathons'));
    }

    /**
     * Processa e armazena a solicitação no banco de dados
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $aluno = $user->aluno;

        if (!$aluno) {
            return redirect()->back()
                ->with('error', 'Aluno não encontrado.')
                ->withInput();
        }

        $validated = $request->validate([
            'hackathons_disponiveis_id' => 'required|exists:hackathons_disponiveis,hackathons_disponiveis_id',
            'metodo_validacao' => 'required|in:Formulário,Imagem,Certificado',
            'arquivo_prova' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            //'aluno_id' => 'required|exists:aluno,aluno_id'
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

            // ✅ DATA NO HORÁRIO DE BRASÍLIA
            $dataBrasilia = now()->setTimezone('America/Sao_Paulo');

            // ✅ CRIAÇÃO DA SOLICITAÇÃO COM STATUS TINYINT
            $solicitacao = new Solicitacao();
            $solicitacao->hackathons_disponiveis_id = $validated['hackathons_disponiveis_id'];
            $solicitacao->metodo_validacao = $validated['metodo_validacao'];
            $solicitacao->arquivo_prova = $caminhoArquivo;
            $solicitacao->aluno_id = $aluno->aluno_id;
            $solicitacao->data_solicitacao = $dataBrasilia;
            $solicitacao->status_solicitacao = Solicitacao::STATUS_PENDENTE;
            
            $solicitacao->save();

            // ✅ DEPOIS (volta para o formulário e mostra o modal):
            return redirect()->route('alunos.solicitacao.index')
                ->with('success', 'Solicitação enviada com sucesso! ID: #' . $solicitacao->solicitacao_id)
                ->with('solicitacao_id', $solicitacao->solicitacao_id);

        } catch (\Exception $e) {
            \Log::error('Erro ao criar solicitação: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // ✅ TEMPORARIAMENTE, mostre o erro completo (REMOVA depois em produção)
            return redirect()->back()
                ->with('error', 'Erro ao enviar solicitação: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Exibe a tela de confirmação após envio da solicitação
     */
    public function confirmacao($id)
    {
        try {
            // Busca a solicitação com os relacionamentos necessários
            $solicitacao = Solicitacao::with(['aluno', 'hackathonDisponivel'])
                ->findOrFail($id);
            
            return view('alunos.solicitacao.confirmacao', compact('solicitacao'));
            
        } catch (\Exception $e) {
            \Log::error('Erro ao buscar solicitação para confirmação: ' . $e->getMessage());
            
            return redirect()->route('alunos.home')
                ->with('error', 'Solicitação não encontrada.');
        }
    }
    /**
     * Exibe todas as solicitações pendentes para o professor
     */
    public function indexProfessor()
    {
        $solicitacoes = Solicitacao::with(['aluno', 'hackathonDisponivel'])
            ->where('status_solicitacao', Solicitacao::STATUS_PENDENTE)
            ->orderBy('data_solicitacao', 'desc')
            ->paginate(10);
        
        return view('solicitacoes.index', compact('solicitacoes'));
    }

    /**
     * Aceita uma solicitação
     */
    public function aceitar($id)
    {
        try {
            $solicitacao = Solicitacao::findOrFail($id);
            
            // Verifica se a solicitação está pendente
            if ($solicitacao->status_solicitacao != Solicitacao::STATUS_PENDENTE) {
                return redirect()->back()
                            ->with('error', 'Esta solicitação já foi processada.');
            }

            // Busca o aluno relacionado à solicitação
            $aluno = Aluno::findOrFail($solicitacao->aluno_id);
            
            // Inicia uma transação para garantir consistência dos dados
            \DB::beginTransaction();
            
            try {
                // Pega o professor autenticado
                $user = Auth::user();
                $professor = $user->professor;

                if (!$professor) {
                    return redirect()->back()->with('error', 'Professor não encontrado.');
                }

                // Atualiza o status da solicitação para aceita
                $solicitacao->status_solicitacao = Solicitacao::STATUS_ACEITA;
                $solicitacao->professor_id = $professor->professor_id;
                $solicitacao->save();
                
                // Adiciona +1 crédito ao aluno
                $aluno->creditos_aluno = $aluno->creditos_aluno + 1;
                $aluno->save();
                
                // Confirma a transação
                \DB::commit();
                
                $nomeAluno = $aluno->nome ?? 'Aluno';
                $creditosAtuais = $aluno->creditos_aluno;
                
                return redirect()->back()
                            ->with('success', "Solicitação de {$nomeAluno} foi aceita com sucesso! ");
                            
            } catch (\Exception $e) {
                // Desfaz a transação em caso de erro
                \DB::rollback();
                throw $e;
            }
            
        } catch (\Exception $e) {
            \Log::error('Erro ao aceitar solicitação: ' . $e->getMessage());
            
            return redirect()->back()
                        ->with('error', 'Erro ao aceitar solicitação. Tente novamente.');
        }
    }

    /**
     * Recusa uma solicitação com observação
     */
    public function recusar(Request $request, $id)
    {
        $validated = $request->validate([
            'observacao' => 'required|string|max:1000'
        ], [
            'observacao.required' => 'Por favor, informe o motivo da recusa.',
            'observacao.max' => 'O motivo não pode ter mais de 1000 caracteres.'
        ]);
        
        try {
            $solicitacao = Solicitacao::findOrFail($id);
            
            // Verifica se a solicitação está pendente
            if ($solicitacao->status_solicitacao != Solicitacao::STATUS_PENDENTE) {
                return redirect()->back()
                            ->with('error', 'Esta solicitação já foi processada.');
            }
            
            // Pega o professor autenticado
            $user = Auth::user();
            $professor = $user->professor;

            if (!$professor) {
                return redirect()->back()->with('error', 'Professor não encontrado.');
            }

            $solicitacao->status_solicitacao = Solicitacao::STATUS_RECUSADA;
            $solicitacao->observacao = $validated['observacao'];
            $solicitacao->professor_id = $professor->professor_id;
            $solicitacao->save();
            
            $nomeAluno = $solicitacao->aluno->nome ?? 'Aluno';
            
            return redirect()->back()
                        ->with('success', "Solicitação de {$nomeAluno} foi recusada.");
                        
        } catch (\Exception $e) {
            \Log::error('Erro ao recusar solicitação: ' . $e->getMessage());
            
            return redirect()->back()
                        ->with('error', 'Erro ao recusar solicitação. Tente novamente.');
        }
    }

    public function acompanharSolicitacoes()
    {
        // Pega o usuário autenticado
        $user = Auth::user();
        
        // Busca o aluno vinculado a esse usuário
        $aluno = $user->aluno;
        
        // Verifica se o aluno existe
        if (!$aluno) {
            return redirect()->back()->with('error', 'Aluno não encontrado.');
        }

        $solicitacoes = Solicitacao::with('aluno', 'hackathonDisponivel')
        ->where('aluno_id', $aluno->aluno_id)
        ->orderBy('data_solicitacao', 'desc')
        ->get();

        return view('alunos.acompanhar-solicitacoes.index', compact('solicitacoes'));
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{

    // Nome da tabela (caso seja diferente do padrão)
    protected $table = 'solicitacao';

    // Chave primária
    protected $primaryKey = 'solicitacao_id';

    // ✅ CONSTANTES PARA status_solicitacao (TINYINT)
    const STATUS_PENDENTE = 0;
    const STATUS_ACEITA = 1;
    const STATUS_RECUSADA = 2;

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'data_solicitacao',
        'arquivo_prova',
        'metodo_validacao',
        'status_solicitacao',
        'observacao',
        'aluno_id',
        'materia_id',
        'professor_id',
        'hackathons_disponiveis_id'
    ];

    // Campos que devem ser tratados como datas
    protected $dates = [
        'data_solicitacao',
        'created_at',
        'updated_at'
    ];

    // ✅ MÉTODOS AUXILIARES PARA STATUS
    public function getStatusTexto()
    {
        switch ($this->status_solicitacao) {
            case self::STATUS_PENDENTE:
                return '🟡 Pendente';
            case self::STATUS_ACEITA:
                return '✅ Aceita';
            case self::STATUS_RECUSADA:
                return '❌ Recusada';
            default:
                return 'Desconhecido';
        }
    }

        public function isPendente()
    {
        return $this->status_solicitacao == self::STATUS_PENDENTE;
    }

    public function isAceita()
    {
        return $this->status_solicitacao == self::STATUS_ACEITA;
    }

    public function isRecusada()
    {
        return $this->status_solicitacao == self::STATUS_RECUSADA;
    }
    
    // Relacionamentos

    /**
     * Relacionamento com HackathonDisponivel
     * Uma solicitacao pertence a um hackathon disponível
     */
    public function hackathonDisponivel()
    {
        return $this->belongsTo(HackathonDisponivel::class, 'hackathons_disponiveis_id', 'hackathons_disponiveis_id');
    }

    /**
     * Relacionamento com Aluno
     * Uma solicitacao pertence a um aluno
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id', 'aluno_id');
    }
    /**
     * Relacionamento com Aluno
     * Uma solicitacao foi respondida por um professor
     */
    public function professor()
    {
        return $this->belongsTo(Professor::class, 'professor_id', 'professor_id');
    }
    // Scopes úteis

    /**
     * Scope para filtrar por status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_solicitacao', $status);
    }

    /**
     * Scope para buscar com informações do hackathon
     */
    public function scopeWithHackathon($query)
    {
        return $query->with('hackathonDisponivel');
    }

    /**
     * Retorna a data que o aluno fez a solicitação formatada de forma segura
     */
    public function getDataFormatada()
    {
        try {
            if ($this->data_solicitacao instanceof \Carbon\Carbon) {
                return $this->data_solicitacao->format('d/m/Y H:i');
            } else {
                return \Carbon\Carbon::parse($this->data_solicitacao)->format('d/m/Y H:i');
            }
        } catch (\Exception $e) {
            return 'Data não disponível';
        }
    }
}
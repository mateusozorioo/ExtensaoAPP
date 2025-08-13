<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{

    // Nome da tabela (caso seja diferente do padrão)
    protected $table = 'solicitacao';

    // Chave primária
    protected $primaryKey = 'solicitacao_id';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'data_solicitacao',
        'arquivo_prova',
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
     * Relacionamento com Materia
     * Uma solicitacao pertence a uma matéria
     */
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id', 'materia_id');
    }

    /**
     * Relacionamento com Professor
     * Uma solicitacao pertence a um professor
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
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    // 1) Diga qual tabela usar 
    protected $table = 'aluno';

    // 2) Informe a chave primária, caso não seja "id"
    protected $primaryKey = 'aluno_id';

    // 3) Desativa o laravel de preencher as colunas 'created_at' e 'updated_at' da tabela 'materia' (o que não é muito bom para a organização)
    // public $timestamps = false;  -- desativei pois foram criadas as colunas

    // 4) Deixe claro que é auto-increment e inteiro
    public $incrementing = true;
    protected $keyType = 'int';

    // 5) Quais campos podem ser preenchidos automaticamente, em massa (mass assignment) - $fillable
    protected $fillable = [
        'user_id',
        'nome',
        'email',
        'creditos_aluno',
        'materia_id',
        'materia_anulada',
    ];

    // ✅ CONSTANTES PARA status_solicitacao (TINYINT)
    const STATUS_REALIZANDO = 0;
    const STATUS_ANULADA = 1;

    // ✅ MÉTODOS AUXILIARES PARA STATUS
    public function getStatusTexto()
    {
        switch ($this->materia_anulada) {
            case self::STATUS_REALIZANDO:
                return 'Realizando✅';
            case self::STATUS_ANULADA:
                return 'Anulou❌';
            default:
                return 'Realizando';
        }
    }


    //Relacionamento com a tabela 'matéria'
    public function materia(){
        return $this->belongsTo(Materia::class,'materia_id', 'materia_id'); // Corrigido: belongsTo (não belongTo) e adicionada a chave local
    }
    /**
     * Relacionamento com Solicitações
     * Um aluno pode ter várias solicitações
     */
    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class, 'aluno_id', 'aluno_id');
    }

    // Relacionamento com User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

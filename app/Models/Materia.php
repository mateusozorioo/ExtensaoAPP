<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    // 1) Diga qual tabela usar (se não for o plural padrão "materias")
    protected $table = 'materia';

    // 2) Informe a chave primária, caso não seja "id"
    protected $primaryKey = 'materia_id';

    // 3) Desativa o laravel de preencher as colunas 'created_at' e 'updated_at' da tabela 'materia' (o que não é muito bom para a organização)
    // public $timestamps = false;  -- desativei pois foram criadas as colunas

    // 4) Deixe claro que é auto-increment e inteiro
    public $incrementing = true;
    protected $keyType = 'int';

    // 5) Quais campos podem ser preenchidos automaticamente, em massa (mass assignment) - $fillable
    protected $fillable = [
        'nome_materia',
        'bimestre_cubo',
        'professor_id',
    ];

    // Relacionamento com Professor
    public function professor()
    {
        return $this->belongsTo(Professor::class, 'professor_id', 'professor_id');
    }
}
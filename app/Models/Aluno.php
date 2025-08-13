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
        'aluno_id',
        'nome',
        'matricula',
        'email',
        'curso',
        'pontuacao_hackathon',
        'bimestre_cubo',
        'materia_id',
    ];

    //Relacionamento com a tabela 'matéria'
    public function materia(){
        return $this->belongTo(Materia::class,'materia_id'); //isso diz que a coluna 'materia_id' de aluno é a FK que aponta para a PK da tabela 'materia'
    }
}

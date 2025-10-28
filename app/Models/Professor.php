<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    // 1) Diga qual tabela usar (se não for o plural padrão "professors")
    protected $table = 'professor';

    // 2) Informe a chave primária, caso não seja "id"
    protected $primaryKey = 'professor_id';

    // 3) Desativa o laravel de preencher as colunas 'created_at' e 'updated_at' da tabela 'professor' (o que não é muito bom para a organização)
    // public $timestamps = false;  -- desativei pois foram criadas as colunas

    // 4) Deixe claro que é auto-increment e inteiro
    public $incrementing = true;
    protected $keyType = 'int';

    // 5) Quais campos podem ser preenchidos automaticamente, em massa (mass assignment) - $fillable
    protected $fillable = [
        'user_id',
        'nome',
        'email',
    ];
}
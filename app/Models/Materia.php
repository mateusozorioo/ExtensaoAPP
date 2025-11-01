<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Helpers\BimestreHelper;

class Materia extends Model
{
    // 1) Diga qual tabela usar
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

    /**
     * 🔄 FILTRO AUTOMÁTICO: Só mostra matérias do bimestre atual
     * Global Scope aplica este filtro em TODAS as queries automaticamente
     */
    protected static function booted()
    {
        static::addGlobalScope('bimestre_atual', function (Builder $builder) {
            $inicioBimestre = BimestreHelper::getInicioBimestreAtual();
            
            // Só mostra matérias criadas a partir do início do bimestre atual
            $builder->where('created_at', '>=', $inicioBimestre);
        });
    }

    /**
     * ⚙️ MÉTODO AUXILIAR: Remove o filtro quando necessário
     * Use Materia::withoutGlobalScope('bimestre_atual')->get() 
     * para ver todas as matérias (ex: relatórios administrativos)
     */
    public function scopeTodasMaterias($query)
    {
        return $query->withoutGlobalScope('bimestre_atual');
    }

    // Relacionamento com Professor
    public function professor()
    {
        return $this->belongsTo(Professor::class, 'professor_id', 'professor_id');
    }
}
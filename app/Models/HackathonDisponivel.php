<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HackathonDisponivel extends Model
{
    use HasFactory;

    // 1) Diga qual tabela usar (necessário porque o nome não segue o padrão plural automático)
    protected $table = 'hackathons_disponiveis';

    // 2) Informe a chave primária, caso não seja "id" (seguindo padrão do seu sistema)
    protected $primaryKey = 'hackathons_disponiveis_id';

    // 3) Os timestamps estão ATIVADOS (created_at e updated_at)
    // Como criamos as colunas na migration, não precisamos desativar
    // public $timestamps = false; -- NÃO usar esta linha

    // 4) Deixe claro que é auto-increment e inteiro
    public $incrementing = true;
    protected $keyType = 'int';

    // 5) Quais campos podem ser preenchidos automaticamente em massa (mass assignment)
    protected $fillable = [
        'hackathon_nome',        // Nome do hackathon
        'hackathon_link',        // Link de inscrição
        'hackathon_imagem',      // Caminho da imagem
        'hackathon_mime_type',   // Tipo MIME da imagem
    ];

    // 6) Campos que devem ser tratados como datas (opcional, mas boa prática)
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // 7) Mutators para processamento de dados
    
    /**
     * Mutator para garantir que o link sempre tenha protocolo
     */
    public function setHackathonLinkAttribute($value)
    {
        // Se o link não começar com http:// ou https://, adiciona https://
        if (!preg_match('/^https?:\/\//', $value)) {
            $this->attributes['hackathon_link'] = 'https://' . $value;
        } else {
            $this->attributes['hackathon_link'] = $value;
        }
    }

    /**
     * Accessor para retornar o nome em maiúsculo (opcional)
     */
    public function getHackathonNomeUpperAttribute()
    {
        return strtoupper($this->hackathon_nome);
    }

    /**
     * Accessor para obter a URL completa da imagem
     */
    public function getImagemUrlAttribute()
    {
        if ($this->hackathon_imagem) {
            return asset($this->hackathon_imagem);
        }
        return null;
    }

    /**
     * Relacionamento com Solicitações
     * Um hackathon pode ter várias solicitações
     */
    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class, 'hackathons_disponiveis_id', 'hackathons_disponiveis_id');
    }
}
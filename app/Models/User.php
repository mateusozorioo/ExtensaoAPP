<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relacionamento com Aluno
    public function aluno()
    {
        return $this->hasOne(Aluno::class, 'user_id');
    }

    // Relacionamento com Professor
    public function professor()
    {
        return $this->hasOne(Professor::class, 'user_id');
    }

    // Método auxiliar para verificar se é aluno
    public function isAluno()
    {
        return $this->aluno !== null;
    }

    // Método auxiliar para verificar se é professor
    public function isProfessor()
    {
        return $this->professor !== null;
    }

    // Método para pegar o tipo de usuário
    public function getTipo()
    {
        if ($this->isAluno()) {
            return 'aluno';
        }
        if ($this->isProfessor()) {
            return 'professor';
        }
        return null;
    }
}

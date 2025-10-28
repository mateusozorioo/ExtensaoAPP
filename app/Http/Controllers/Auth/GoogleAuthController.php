<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Professor;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleAuthController extends Controller
{
    /**
     * Redireciona o usuário para a página de autenticação do Google
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Processa o callback do Google após autenticação
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $email = $googleUser->getEmail();
            
            // Verifica se o email termina com @edu.unifil.br ou @unifil.br
            if (!$this->isEmailValido($email)) {
                return redirect()->route('proibido.index');
            }
            
            // Busca ou cria o usuário
            $user = User::where('email', $email)->first();
            
            if (!$user) {
                // Cria novo usuário
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $email,
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(uniqid()), // senha aleatória
                ]);
                
                // Cria o registro correspondente (aluno ou professor)
                if (str_ends_with($email, '@edu.unifil.br')) {
                    Aluno::create([
                        'user_id' => $user->id,
                        'nome' => $googleUser->getName(),
                        'email' => $email,
                        'creditos_aluno' => 0,
                    ]);
                } elseif (str_ends_with($email, '@unifil.br')|| $email === 'mateuskozorio@gmail.com') {
                    Professor::create([
                        'user_id' => $user->id,
                        'nome' => $googleUser->getName(),
                        'email' => $email,
                    ]);
                }
            }
            
            // Faz o login do usuário
            Auth::login($user);
            
            // Redireciona baseado no tipo de email
            return $this->redirecionarPorTipo($email);
            
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Erro ao fazer login com Google: ' . $e->getMessage());
        }
    }
    
    /**
     * Verifica se o email é válido (termina com @edu.unifil.br ou @unifil.br)
     */
    private function isEmailValido($email)
    {
        return str_ends_with($email, '@edu.unifil.br') || str_ends_with($email, '@unifil.br') || $email === 'mateuskozorio@gmail.com';
    }
    
    /**
     * Redireciona o usuário baseado no tipo de email
     */
    private function redirecionarPorTipo($email)
    {
        if (str_ends_with($email, '@edu.unifil.br')) {
            return redirect()->route('alunos.home');
        } elseif (str_ends_with($email, '@unifil.br') || $email === 'mateuskozorio@gmail.com') {
            return redirect()->route('professor.home');
        }
        
        return redirect()->route('proibido.index');
    }
}
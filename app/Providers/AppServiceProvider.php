<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Composers\HeaderProfessorComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registra que SEMPRE que a view 'includes.headerAluno' for carregada, o HeaderAlunoComposer deve ser executado automaticamente
        View::composer('includes.headerAluno', 'App\Http\Controllers\Composers\HeaderAlunoComposer');

        // Mesma coisa para o professor
        View::composer('includes.header', 'App\Http\Controllers\Composers\HeaderProfessorComposer');
    }
}
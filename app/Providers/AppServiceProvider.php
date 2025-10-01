<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
    }
}
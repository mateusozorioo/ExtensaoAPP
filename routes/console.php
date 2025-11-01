<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; // ← ADICIONE

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// ========================================
//   AGENDAMENTO DO RESET DE BIMESTRE
// ========================================
Schedule::command('bimestre:reset')
    ->monthlyOn(1, '00:01')
    ->withoutOverlapping();
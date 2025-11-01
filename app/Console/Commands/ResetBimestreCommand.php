<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aluno;
use App\Helpers\BimestreHelper;
use Illuminate\Support\Facades\DB;

class ResetBimestreCommand extends Command
{
    /**
     * Nome do comando
     */
    protected $signature = 'bimestre:reset';

    /**
     * Descrição do comando
     */
    protected $description = 'Reseta materia_anulada de todos os alunos para o início do novo bimestre';

    /**
     * Executa o comando
     */
    public function handle()
    {
        $this->info('🔄 Iniciando reset de bimestre...');

        // Verifica se é dia de reset
        if (!BimestreHelper::isPrimeiroDiaBimestre()) {
            $this->warn('⚠️ Hoje não é dia de reset de bimestre (1º fev/abr/jul/out)');
            return 0;
        }

        try {
            // Reseta todos os alunos com materia_anulada = 1 para 0
            $alunosAtualizados = DB::table('aluno')
                ->where('materia_anulada', 1)
                ->update(['materia_anulada' => 0]);

            $this->info("✅ {$alunosAtualizados} aluno(s) resetado(s) com sucesso!");
            $this->info("📅 Bimestre atual: " . BimestreHelper::getBimestreAtualIdentificador());

            return 0;

        } catch (\Exception $e) {
            $this->error("❌ Erro ao resetar bimestre: " . $e->getMessage());
            return 1;
        }
    }
}
<?php

namespace App\Helpers;

use Carbon\Carbon;

class BimestreHelper
{
    /**
     * Retorna a data de início do bimestre atual
     * Bimestres começam em: 1º fev, 1º abr, 1º jul, 1º out
     */
    public static function getInicioBimestreAtual()
    {
        $hoje = Carbon::now();
        $ano = $hoje->year;
        $mes = $hoje->month;

        // Define as datas de início de cada bimestre
        $iniciosBimestre = [
            Carbon::create($ano, 2, 1, 0, 0, 0),  // 1º fevereiro
            Carbon::create($ano, 4, 1, 0, 0, 0),  // 1º abril
            Carbon::create($ano, 7, 1, 0, 0, 0),  // 1º julho
            Carbon::create($ano, 10, 1, 0, 0, 0), // 1º outubro
        ];

        // Se estamos antes de fevereiro, pega outubro do ano anterior
        if ($mes < 2) {
            return Carbon::create($ano - 1, 10, 1, 0, 0, 0);
        }

        // Encontra o início do bimestre atual
        $bimestreAtual = null;
        foreach ($iniciosBimestre as $inicio) {
            if ($hoje->greaterThanOrEqualTo($inicio)) {
                $bimestreAtual = $inicio;
            }
        }

        return $bimestreAtual;
    }

    /**
     * Verifica se é o primeiro dia do bimestre
     */
    public static function isPrimeiroDiaBimestre()
    {
        $hoje = Carbon::now();
        $dia = $hoje->day;
        $mes = $hoje->month;

        return $dia === 1 && in_array($mes, [2, 4, 7, 10]);
    }

    /**
     * Retorna identificador único do bimestre atual (ex: "2025-1", "2025-2")
     */
    public static function getBimestreAtualIdentificador()
    {
        $hoje = Carbon::now();
        $ano = $hoje->year;
        $mes = $hoje->month;

        if ($mes >= 2 && $mes < 4) {
            return $ano . '-1'; // 1º bimestre
        } elseif ($mes >= 4 && $mes < 7) {
            return $ano . '-2'; // 2º bimestre
        } elseif ($mes >= 7 && $mes < 10) {
            return $ano . '-3'; // 3º bimestre
        } else {
            return $ano . '-4'; // 4º bimestre
        }
    }
}
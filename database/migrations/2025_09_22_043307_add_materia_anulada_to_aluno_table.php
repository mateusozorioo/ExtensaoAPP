<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('aluno', function (Blueprint $table) {
            $table->boolean('materia_anulada')->default(false);
        });
    }

    public function down()
    {
        Schema::table('aluno', function (Blueprint $table) {
            $table->dropColumn('materia_anulada');
        });
    }

};

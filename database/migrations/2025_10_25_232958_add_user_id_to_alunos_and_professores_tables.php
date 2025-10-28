<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Adiciona user_id na tabela alunos
        Schema::table('aluno', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('aluno_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique('user_id');
        });

        // Adiciona user_id na tabela professor
        Schema::table('professor', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('professor_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique('user_id');
        });
    }

    public function down()
    {
        Schema::table('aluno', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('professor', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
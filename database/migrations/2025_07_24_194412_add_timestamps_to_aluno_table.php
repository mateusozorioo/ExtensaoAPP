<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('aluno', function (Blueprint $table) {
            $table->timestamps(); //isso adiciona created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aluno', function (Blueprint $table) {
            $table->dropTimestamps(); //isso remove created_at e update_at da tabela aluno com um comando
        });
    }
};

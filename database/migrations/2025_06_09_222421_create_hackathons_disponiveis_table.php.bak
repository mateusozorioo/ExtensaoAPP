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
        Schema::create('hackathons_disponiveis', function (Blueprint $table) {
            // Chave primária auto-incremento
            $table->id('hackathons_disponiveis_id');
            
            // Campo para o nome do hackathon
            $table->string('hackathon_nome', 255)->comment('Nome do hackathon');
            
            // Campo para o link de inscrição
            $table->text('hackathon_link')->comment('Link de inscrição do hackathon');
            
            // Campo para o caminho da imagem
            $table->string('hackathon_imagem', 500)->comment('Caminho da imagem do hackathon');
            
            // Campos de timestamp - created_at e updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hackathons_disponiveis');
    }
};
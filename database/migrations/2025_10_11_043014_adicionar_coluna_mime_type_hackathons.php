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
        Schema::table('hackathons_disponiveis', function (Blueprint $table) {
            $table->string('hackathon_mime_type', 50)->nullable()->after('hackathon_imagem');
        });
    }

    public function down()
    {
        Schema::table('hackathons_disponiveis', function (Blueprint $table) {
            $table->dropColumn('hackathon_mime_type');
        });
    }
};

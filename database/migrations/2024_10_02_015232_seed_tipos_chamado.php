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
        DB::table('tipos_chamado')->insert([
            ['nome' => 'Problema de Rede'],
            ['nome' => 'Acesso no Siga'],
            ['nome' => 'Acesso no Teams'],
            ['nome' => 'Problema no Computador'],
            ['nome' => 'Problema na Impressora'],
            ['nome' => 'Outros']
        ]);
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipos_chamado', function (Blueprint $table) {
            //
        });
    }
};

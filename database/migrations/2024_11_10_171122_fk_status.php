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
        Schema::table('chamados', function (Blueprint $table) {
            $table->foreign('status_id')
                  ->references('id')  // Aqui você especifica a coluna da tabela de destino (geralmente 'id')
                  ->on('status')      // Aqui você especifica o nome da tabela que contém a chave primária
                  ->onDelete('cascade');  // Especifica o que acontece quando o registro da tabela de status é deletado (opcional)
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chamados', function (Blueprint $table) {
            //
        });
    }
};

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
        // Adicionar a coluna tipo_id sem a chave estrangeira primeiro
        Schema::table('chamados', function (Blueprint $table) {
            $table->foreignId('tipo_id')->nullable()->after('id'); // Permite nulo temporariamente
        });
    
        // Atualizar todos os registros existentes para ter um valor padrão para tipo_id
        DB::table('chamados')->update(['tipo_id' => 1]); // Supondo que o ID 1 seja "Outros"
    
        // Agora adicionar a restrição de chave estrangeira
        Schema::table('chamados', function (Blueprint $table) {
            $table->foreign('tipo_id')->references('id')->on('tipos_chamado');
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

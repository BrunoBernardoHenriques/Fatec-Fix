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
        Schema::create('atualizacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chamado_id')->constrained()->onDelete('cascade');
            $table->text('descricao');
            $table->foreignId('usuario_id')->constrained('users'); // Assume que a tabela de usuários se chama 'users'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atualizacoes');
    }
};

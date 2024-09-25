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
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->text('descricao_resumida');
            $table->text('descricao_completa')->nullable(); // Corrigido para `nullable()`
            $table->string('local');
            $table->string('solicitante');
            $table->dateTime('data_abertura');
            $table->dateTime('data_encerramento')->nullable();
            $table->enum('status', ['Aberto', 'Em Andamento', 'Encerrado'])->default('Aberto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};
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
        Schema::table('chamados', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->after('solicitante'); // Adiciona a coluna status_id
            $table->dropColumn('status'); // Remove a coluna status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->enum('status', ['Aberto', 'Em Andamento', 'Encerrado'])->default('Aberto')->after('solicitante'); // Adiciona a coluna status
            $table->dropColumn('status_id'); // Remove a coluna status_id
        });
    }
};

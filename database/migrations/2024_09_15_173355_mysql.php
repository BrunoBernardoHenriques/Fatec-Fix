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
            // Adiciona a coluna local_id como chave estrangeira
            $table->unsignedBigInteger('local_id')->nullable()->after('solicitante'); // Após solicitante

            // Define a relação com a tabela locais
            $table->foreign('local_id')->references('id')->on('locais')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chamados', function (Blueprint $table) {
            // Remove a foreign key e a coluna
            $table->dropForeign(['local_id']);
            $table->dropColumn('local_id');
        });
    }
};

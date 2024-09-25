<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chamados', function (Blueprint $table) {
            // Se a coluna já existir, remova-a primeiro
            if (Schema::hasColumn('chamados', 'local_id')) {
                $table->dropColumn('local_id');
            }

            // Agora adicione a coluna novamente
            $table->unsignedBigInteger('local_id')->nullable()->after('solicitante');
            $table->foreign('local_id')->references('id')->on('locais')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->dropForeign(['local_id']);
            $table->dropColumn('local_id');
        });
    }
};

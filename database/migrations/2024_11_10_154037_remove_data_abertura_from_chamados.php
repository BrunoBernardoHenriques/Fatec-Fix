<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDataAberturaFromChamados extends Migration
{
    public function up()
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->dropColumn('data_abertura'); // Remove a coluna 'data_abertura'
        });
    }

    public function down()
    {
        // Caso precise reverter a migration, você pode adicionar a coluna novamente
        Schema::table('chamados', function (Blueprint $table) {
            $table->timestamp('data_abertura')->nullable(); // Ou usar o tipo adequado para a coluna
        });
    }
}

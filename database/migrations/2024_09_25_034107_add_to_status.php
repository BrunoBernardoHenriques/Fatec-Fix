<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('status')->insert([
            ['nome' => 'Aberto'],
            ['nome' => 'Em Andamento'],
            ['nome' => 'Encerrado'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('status')->whereIn('nome', ['Aberto', 'Em Andamento', 'Encerrado'])->delete();
    }
};

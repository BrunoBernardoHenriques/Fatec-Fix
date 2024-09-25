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
        DB::table('locais')->insert([
            ['nome' => 'Laboratório 1'],
            ['nome' => 'Laboratório 2'],
            ['nome' => 'Laboratório 3'],
            ['nome' => 'Laboratório 4'],
            ['nome' => 'Laboratório 5'],
            ['nome' => 'Laboratório 6'],
            ['nome' => 'Laboratório 7'],
            ['nome' => 'Laboratório 8'],
            ['nome' => 'Laboratório 9'],
            ['nome' => 'Secretária'],
            ['nome' => 'Sala dos Professores'],
            ['nome' => 'Biblioteca'],
            ['nome' => 'Almoxarifado'],
            ['nome' => 'Sala 1 Bloco 3'],
            ['nome' => 'Sala 2 Bloco 3'],
            ['nome' => 'Sala 3 Bloco 3'],
            ['nome' => 'Sala 4 Bloco 3'],
            ['nome' => 'Sala 5 Bloco 3'],
            ['nome' => 'Sala 6 Bloco 3'],
            ['nome' => 'Sala 7 Bloco 3'],
            ['nome' => 'Sala 8 Bloco 3'],
            ['nome' => 'Sala 9 Bloco 3'],
            ['nome' => 'Sala 1 Bloco 2'],
            ['nome' => 'Sala 2 Bloco 2'],
            ['nome' => 'Sala 3 Bloco 2'],
            ['nome' => 'Sala 1 Bloco 1'],
            ['nome' => 'Sala 2 Bloco 1'],
            ['nome' => 'Sala 3 Bloco 1'],
            ['nome' => 'Sala 4 Bloco 1'],
            ['nome' => 'Sala 5 Bloco 1'],
            ['nome' => 'Sala 6 Bloco 1'],
            ['nome' => 'Sala 7 Bloco 1'],
            ['nome' => 'Sala 8 Bloco 1'],
            ['nome' => 'Sala 9 Bloco 1'],
            ['nome' => 'Sala 10 Bloco 1'],
            ['nome' => 'Sala 11 Bloco 1'],
            ['nome' => 'Sala 12 Bloco 1'],
            ['nome' => 'Sala 13 Bloco 1'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('locais')->truncate();
    }
};

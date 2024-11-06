<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddUserTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insere os tipos de usuários na tabela user_types
        DB::table('user_types')->insert([
            ['type_name' => 'Administrador'],
            ['type_name' => 'Comum'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove os tipos de usuários da tabela user_types
        DB::table('user_types')->whereIn('type_name', ['Administrador', 'Comum'])->delete();
    }
}

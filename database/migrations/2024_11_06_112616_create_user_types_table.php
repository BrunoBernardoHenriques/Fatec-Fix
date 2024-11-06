<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTable extends Migration
{
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name'); // Nome do tipo de usuário (por exemplo: "Admin", "User", etc.)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}


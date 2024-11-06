<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    // Define a tabela associada (caso o nome seja diferente de 'user_types')
    protected $table = 'user_types'; 

    // Defina as colunas que podem ser preenchidas no modelo
    protected $fillable = [
        'type_name', // Nome do tipo (ex: Administrador, Comum)
    ];

    /**
     * Relacionamento com o modelo User
     * Um tipo de usuário pode ter muitos usuários.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'type'); // O 'type' é a chave estrangeira na tabela users
    }
    public function userType()
    {
        return $this->belongsTo(UserType::class, 'type');
    }
    
    
}

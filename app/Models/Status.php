<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status'; // Nome da tabela no banco de dados

    protected $fillable = [
        'nome', // Campos que podem ser preenchidos em massa
    ];

    public function chamados()
    {
        return $this->hasMany(Chamado::class, 'status_id'); // Relacionamento com a tabela de chamados
    }
}

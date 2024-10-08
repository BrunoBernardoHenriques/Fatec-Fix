<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;
    protected $table = 'locais'; 
    protected $fillable = ['nome'];

    // Definindo a relação com chamados
    public function chamados()
    {
        return $this->hasMany(Chamado::class);
    }
}

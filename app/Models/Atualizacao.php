<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atualizacao extends Model
{
    use HasFactory;

   protected $table = 'atualizacoes'; 
    protected $fillable = [
        'chamado_id',
        'descricao',
        'usuario_id',
    ];

    // Relação com o modelo Chamado
    public function chamado()
    {
        return $this->belongsTo(Chamado::class);
    }

    // Relação com o modelo User (usuário)
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoChamado extends Model
{
    protected $table = 'tipos_chamado';

    protected $fillable = ['nome'];
}

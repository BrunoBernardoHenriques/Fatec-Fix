<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'descricao_resumida',
        'descricao_completa',
        'local',
        'solicitante',
        'data_abertura',
        'data_encerramento',
        'status',
        'created_by',
        'updated_by',
    ];


    public function status()
    {
        return $this->belongsTo(Status::class); // A relação é 'belongsTo' pois um chamado tem um status
    }




    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function local()
{
    return $this->belongsTo(Local::class, 'local_id');
}
public function atualizacoes()
{
    return $this->hasMany(Atualizacao::class);
}
}

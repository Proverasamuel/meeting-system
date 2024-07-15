<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decisorio extends Model
{
    use HasFactory;

    protected $fillable = ['reuniao_id', 'descricao', 'responsavel_id'];

    public function reuniao()
    {
        return $this->belongsTo(Reuniao::class);
    }

    public function responsavel()
    {
        return $this->belongsTo(Colaborador::class);
    }
}
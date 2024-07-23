<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convidado extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'funcao',
        'area',
        'assinatura',
        'reuniao_id',
    ];

    public function reuniao()
    {
        return $this->belongsTo(Reuniao::class);
    }
}

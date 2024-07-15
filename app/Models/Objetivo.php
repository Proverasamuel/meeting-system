<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'reuniao_id',
        'descricao',
    ];

    public function reuniao()
    {
        return $this->belongsTo(Reuniao::class);
    }
}

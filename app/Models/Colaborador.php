<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\hash;
class Colaborador extends Model
{
    use HasFactory;
    protected $table = 'colaboradores';

    protected $fillable = [
        'name',
        'email',
        'senha',
    ];

    public function ata()
    {
        return $this->hasMany(ata::class, 'responsavel_id');
    }

    public function decisions()
    {
        return $this->hasMany(Decisorio::class, 'responsavel_id');
    }

    public function participantes()
    {
        return $this->hasMany(Participante::class);
    }
}

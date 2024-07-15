<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reuniao extends Model
{
    use HasFactory;
    protected $table = 'reuniao'; // Specify your table name here
    
    protected $fillable = ['titulo', 'data','hora_inicio','hora_fim', 'local', 'nivel','status'];

    public function ata()
    {
        return $this->hasOne(ata::class);
    }

    public function decisorio()
    {
        return $this->hasMany(Decisorio::class);
    }

    public function participantes()
    {
        return $this->hasMany(Participante::class, 'reuniao_id');
    }
    public function departamento()
    {
        return $this->belongsToMany(Departamento::class);
    }

    public function objetivos()
    {
        return $this->hasMany(Objetivo::class);
    }
}

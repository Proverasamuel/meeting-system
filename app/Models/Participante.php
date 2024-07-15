<?php

// App\Models\Participante.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;
    
    protected $table = 'participantes';
    protected $fillable = ['reuniao_id', 'colaborador_id', 'presente'];

    public function reuniao()
    {
        return $this->belongsTo(Reuniao::class);
    }

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }
}

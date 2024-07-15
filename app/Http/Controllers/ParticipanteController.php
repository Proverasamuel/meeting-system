<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colaborador;
use App\Models\Participante;

class ParticipanteController extends Controller
{
    //

    public function verifyPassword(Request $request)
{
    $colaborador = Colaborador::find($request->colaborador_id);

    if (Hash::check($request->password, $colaborador->senha)) {
        $participante = Participante::find($request->participante_id);
        $participante->presente = true;
        $participante->save();
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false]);
    }
}
}

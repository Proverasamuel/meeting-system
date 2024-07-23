<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convidado;
use App\Models\Reuniao;

class ConvidadoController extends Controller
{
    public function store(Request $request, $reuniaoId)
    {
        $reuniao = Reuniao::find($reuniaoId);
    
        if (!$reuniao) {
            return redirect()->route('reuniao.index')->withErrors('Reunião não encontrada.');
        }
    
        foreach ($request->convidado as $convidado) {
            Convidado::create([
                'nome' => $convidado['nome'],
                'funcao' => $convidado['funcao'],
                'area' => $convidado['area'],
                'assinatura' => $convidado['assinatura'],
                'reuniao_id' => $reuniao->id
            ]);
        }
    
        return redirect()->route('reuniao.participantes', $reuniaoId)->with('success', 'Convidado(s) adicionado(s) com sucesso!');
    }
    
}

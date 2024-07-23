<?php

namespace App\Http\Controllers;

use App\Models\Reuniao;
use App\Models\Objetivo;
use Illuminate\Http\Request;
use App\Models\Participante;
use App\Models\Colaborador;
use App\Models\Convidado;

class ReuniaoController extends Controller
{
    public function index()
    {
        // Lista todas as reuniões, juntamente com os colaboradores que participam
        $reunioes = Reuniao::all();
        $colaboradores = Colaborador::all();
        return view('reuniao.index', compact('reunioes', 'colaboradores'));
    }

    public function create()
    {
        return view('reuniao.create');
    }

    public function store(Request $request)
    {
        $reuniao = new Reuniao();
        $reuniao->titulo = $request->input('titulo');
        $reuniao->data = $request->input('data');
        $reuniao->hora_inicio = $request->input('hora_inicio');
        $reuniao->hora_fim = $request->input('hora_fim');
        $reuniao->local = $request->input('local');
        $reuniao->nivel = $request->input('nivel'); // Adiciona o campo "nível"
        $reuniao->status = 'Pendente'; // Define um status inicial
        $reuniao->save();

        $objetivos = $request->input('objetivo_descricao');
        foreach ($objetivos as $descricao) {
            $objetivo = new Objetivo();
            $objetivo->reuniao_id = $reuniao->id;
            $objetivo->descricao = $descricao;
            $objetivo->save();
        }

        $participantes = $request->input('participantes');
        foreach ($participantes as $participanteId) {
            $participante = new Participante();
            $participante->reuniao_id = $reuniao->id;
            $participante->colaborador_id = $participanteId;
            $participante->presente = false; // Inicializa como não presente
            $participante->save();
        }

        return redirect()->route('reuniao.index')->with('success', 'Reunião criada com sucesso!');
    }


    public function show($id)
    {
        $reuniao = Reuniao::with('participantes.colaborador')->findOrFail($id);
        return view('reuniao.show', compact('reuniao'));
    }

   
    public function edit(Reuniao $reuniao)
    {
        return view('reuniao.edit', compact('reuniao'));
    }

    public function update(Request $request, Reuniao $reuniao)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'data' => 'required|date',
            'hora_inicio' => 'required|string',
            'hora_fim' => 'required|string',
            'local' => 'required|string|max:255',
            'status' => 'required|string',
            'objetivo_descricao.*' => 'required|string|max:255',
            'participantes' => 'required|string|max:255'
        ]);

        $reuniao->update($request->only(['titulo', 'data', 'hora_inicio', 'hora_fim', 'local', 'status']));

        $reuniao->objetivos()->delete();
        foreach ($request->input('objetivo_descricao') as $descricao) {
            $reuniao->objetivos()->create(['descricao' => $descricao]);
        }

        return redirect()->route('reuniao.index');
    }

    public function showParticipantes($id)
    {
        $reuniao = Reuniao::findOrFail($id);
        $participantes = $reuniao->participantes()->with('colaborador')->get();
        $convidados = $reuniao->convidados()->get(); // Assumindo que há um relacionamento 'convidados' definido no modelo Reuniao
    
        return view('reuniao.participantes', compact('reuniao', 'participantes', 'convidados'));
    }
    

    public function updateParticipantes(Request $request, $id)
    {
        $participanteId = $request->input('participante_id');
        $password = $request->input('password');

        $participante = Participante::findOrFail($participanteId);
        $colaborador = Colaborador::findOrFail($participante->colaborador_id);

        // Verifica a senha do colaborador
        if ($colaborador->senha !== $password) {
            return redirect()->route('reuniao.show', $id)->withErrors(['password' => 'Senha incorreta!']);
        }

        // Atualiza a presença
        $participante->presente = !$participante->presente;
        $participante->save();

        return redirect()->route('reuniao.show', $id)->with('success', 'Presença atualizada com sucesso!');
    }

    /* public function verifyPassword(Request $request)
    {
        $participanteId = $request->input('participante_id');
        $password = $request->input('password');

        $participante = Participante::findOrFail($participanteId);
        $colaborador = Colaborador::findOrFail($participante->colaborador_id);

        if ($colaborador->senha === $password) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
 */    public function destroy(Reuniao $reuniao)
    {
        $reuniao->delete();
        return redirect()->route('reuniao.index');
    }
}

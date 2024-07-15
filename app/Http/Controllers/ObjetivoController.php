<?php

namespace App\Http\Controllers;

use App\Models\Objetivo;
use App\Models\Reuniao;
use Illuminate\Http\Request;

class ObjetivoController extends Controller
{
    public function index()
    {
        $objetivos = Objetivo::all();
        return view('objetivos.index', compact('objetivos'));
    }

    public function create()
    {
        $reunioes = Reuniao::all();
        return view('objetivos.create', compact('reunioes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reuniao_id' => 'required|exists:reuniaos,id',
            'descricao' => 'required|string|max:255',
        ]);

        Objetivo::create($request->all());

        return redirect()->route('objetivos.index');
    }

    public function show(Objetivo $objetivo)
    {
        return view('objetivos.show', compact('objetivo'));
    }

    public function edit(Objetivo $objetivo)
    {
        $reunioes = Reuniao::all();
        return view('objetivos.edit', compact('objetivo', 'reunioes'));
    }

    public function update(Request $request, Objetivo $objetivo)
    {
        $request->validate([
            'reuniao_id' => 'required|exists:reuniaos,id',
            'descricao' => 'required|string|max:255',
        ]);

        $objetivo->update($request->all());

        return redirect()->route('objetivos.index');
    }

    public function destroy(Objetivo $objetivo)
    {
        $objetivo->delete();
        return redirect()->route('objetivos.index');
    }
}

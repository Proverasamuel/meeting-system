<!-- resources/views/Reuniao/show.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Detalhes da Reunião</h1>
<div class="card">
    <div class="card-header">
        {{ $reuniao->titulo }}
    </div>
    <div class="card-body">
        <h5 class="card-title">Data: {{ $reuniao->data }}</h5>
        <p class="card-text">Local: {{ $reuniao->local }}</p>
        <p class="card-text">Hora de Início: {{ $reuniao->hora_inicio }}</p>
        <p class="card-text">Hora de Fim: {{ $reuniao->hora_fim }}</p>
        <p class="card-text">Status: {{ $reuniao->status }}</p>
        <p class="card-text">Nível: {{ $reuniao->nivel }}</p>
        
        <h5 class="mt-4">Participantes:</h5>
        <ul>
            @foreach ($reuniao->participantes as $participante)
                <li>
                    {{ $participante->colaborador->name }}
                    @if($participante->presente)
                        - Presente
                    @else
                        - Ausente
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
<a href="{{ route('reuniao.index') }}" class="btn btn-secondary mt-2">Voltar</a>
<a href="{{ route('reuniao.participantes', $reuniao->id) }}" class="btn btn-primary mt-2">Ver Participantes</a>

@endsection

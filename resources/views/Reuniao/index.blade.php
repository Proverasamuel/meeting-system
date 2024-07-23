@extends('layouts.app')

@section('title', 'Reuniões')

@section('content')
<div class="container">
    <h1 class="mb-4">Reuniões</h1>
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#multiStepFormModal">
        Nova Reunião
    </button>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Data</th>
                <th>Hora de Início</th>
                <th>Hora de Fim</th>
                <th>Local</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reunioes as $reuniao)
            <tr>
                <td>{{ $reuniao->titulo }}</td>
                <td>{{ $reuniao->data }}</td>
                <td>{{ $reuniao->hora_inicio }}</td>
                <td>{{ $reuniao->hora_fim }}</td>
                <td>{{ $reuniao->local }}</td>
                <td>{{ $reuniao->status }}</td>
                <td>
                    <a href="{{ route('reuniao.show', $reuniao->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('reuniao.edit', $reuniao->id) }}" class="btn btn-warning">Editar</a>
                    <div class="dropdown mt-2">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Lista
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('generate-pdf', ['id' => $reuniao->id, 'type' => 'colaboradores']) }}">Colaboradores</a>
                            <a class="dropdown-item" href="{{ route('generate-participantes-pdf', ['id' => $reuniao->id, 'type' => 'colaboradores-visitantes']) }}">Colaboradores e visitantes</a>
                        </div>
                    </div>


                    <!-- Botão para abrir a modal de participantes -->
                    <!--    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#participantesModal-{{ $reuniao->id }}">
                        Participantes
                    </button> -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Multi-Step Form -->
<div class="modal fade" id="multiStepFormModal" tabindex="-1" role="dialog" aria-labelledby="multiStepFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="multiStepFormModalLabel">Nova Reunião</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="multiStepForm" method="POST" action="{{ route('reuniao.store') }}">
                    @csrf
                    <!-- Step 1: Informações da Reunião -->
                    <div class="step" id="step1">
                        <h4>Informações da Reunião</h4>
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="nivel" class="form-label">Nível</label>
                            <select class="form-control" name="nivel">
                                <option value="">Selecione o nível...</option>
                                <option value="Estrategia">Estratégia</option>
                                <option value="Sintonia">Sintonia</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" class="form-control" id="data" name="data" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora_inicio" class="form-label">Hora de Início</label>
                            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora_fim" class="form-label">Hora de Fim</label>
                            <input type="time" class="form-control" id="hora_fim" name="hora_fim" required>
                        </div>
                        <div class="mb-3">
                            <label for="local" class="form-label">Local</label>
                            <input type="text" class="form-control" id="local" name="local" required>
                        </div>
                        <button type="button" class="btn btn-primary" id="nextStep1">Próximo</button>
                    </div>

                    <!-- Step 2: Objetivos -->
                    <div class="step" id="step2" style="display: none;">
                        <h4>Objetivos</h4>
                        <div id="objetivo-container">
                            <div class="objetivo-row">
                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <input type="text" class="form-control" name="objetivo_descricao[]" required>
                                </div>
                                <button type="button" class="btn btn-danger remove-objetivo">Remover Objetivo</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary add-objetivo">Adicionar Objetivo</button>
                        <hr>
                        <button type="button" class="btn btn-secondary" id="prevStep2">Anterior</button>
                        <button type="button" class="btn btn-primary" id="nextStep2">Próximo</button>
                    </div>

                    <!-- Step 3: Participantes -->
                    <div class="step" id="step3" style="display: none;">
                        <h4>Participantes</h4>
                        <div class="mb-3">
                            <label for="participantes" class="form-label">Participantes</label>
                            <div>
                                @foreach ($colaboradores as $colaborador)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="participantes[]" value="{{ $colaborador->id }}" id="colaborador{{ $colaborador->id }}">
                                    <label class="form-check-label" for="colaborador{{ $colaborador->id }}">
                                        {{ $colaborador->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <button type="button" class="btn btn-secondary" id="prevStep3">Anterior</button>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach ($reunioes as $reuniao)
<!-- Modal para exibir os participantes -->
<div class="modal fade" id="participantesModal-{{ $reuniao->id }}" tabindex="-1" role="dialog" aria-labelledby="participantesModalLabel-{{ $reuniao->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="participantesModalLabel-{{ $reuniao->id }}">Participantes da Reunião: {{ $reuniao->titulo }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('reuniao.participantes.update', $reuniao->id) }}">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Presente</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reuniao->participantes as $participante)
                            <tr>
                                <td>{{ $participante->colaborador->name }}</td>
                                <td>
                                    <input type="checkbox" name="participantes[]" value="{{ $participante->id }}" {{ $participante->presente ? 'checked' : '' }}>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var currentStep = 0;
        var steps = $(".step");
        steps.hide();
        $(steps[0]).show();

        $("#nextStep1").click(function() {
            $(steps[currentStep]).hide();
            currentStep++;
            $(steps[currentStep]).show();
        });

        $("#prevStep2").click(function() {
            $(steps[currentStep]).hide();
            currentStep--;
            $(steps[currentStep]).show();
        });

        $("#nextStep2").click(function() {
            $(steps[currentStep]).hide();
            currentStep++;
            $(steps[currentStep]).show();
        });

        $("#prevStep3").click(function() {
            $(steps[currentStep]).hide();
            currentStep--;
            $(steps[currentStep]).show();
        });

        $(".add-objetivo").click(function() {
            var newObjetivo = $(".objetivo-row").first().clone();
            newObjetivo.find("input").val("");
            $("#objetivo-container").append(newObjetivo);
        });

        $(document).on("click", ".remove-objetivo", function() {
            $(this).closest(".objetivo-row").remove();
        });
    });
</script>
@endsection
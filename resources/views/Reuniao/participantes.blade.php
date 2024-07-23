@extends('layouts.app')

@section('title', 'Participantes da Reunião')

@section('content')
<div class="container">
    <h1 class="mb-4">Participantes da Reunião: {{ $reuniao->titulo }}</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <form id="presenceForm" method="POST" action="{{ route('reuniao.participantes.update', $reuniao->id) }}">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Função</th>
                    <th>Área</th>
                    <th>Presente</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participantes as $participante)
                <tr>
                    <td>{{ $participante->colaborador->name }}</td>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="checkbox" class="presence-checkbox" data-participante-id="{{ $participante->id }}" {{ $participante->presente ? 'checked' : '' }}>
                    </td>
                </tr>
                @endforeach
                @foreach ($convidados as $convidado)
            <tr>
                <td>{{ $convidado->nome }}</td>
                <td>{{ $convidado->funcao }}</td>
                <td>{{ $convidado->area }}</td>
                <td>
                        <input type="checkbox" class="presence-checkbox" data-participante-id="{{ $convidado->id }}" {{ $convidado->presente ? 'checked' : '' }}>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <input type="hidden" id="participante_id" name="participante_id" value="">
        <input type="hidden" id="password" name="password" value="">
        <button type="submit" class="btn btn-primary d-none" id="submitBtn">Salvar Presenças</button>
    </form>
    <a href="{{ route('reuniao.index') }}" class="btn btn-secondary mt-2">Voltar</a>
    <!-- Botão para adicionar convidados -->
    <button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#addGuestModal">Adicionar Convidado</button>

   <!--  <h2 class="mt-5">Convidados</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Função</th>
                <th>Área</th>
            </tr>
        </thead>
        <tbody>
         
        </tbody>
    </table> -->
</div>

<!-- Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Verifique sua Senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="passwordForm">
                    <div class="form-group">
                        <label for="modal-password">Senha</label>
                        <input type="password" class="form-control" id="modal-password" required>
                    </div>
                    <button type="button" class="btn btn-primary" id="verifyPasswordBtn">Verificar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Guest Modal -->
<div class="modal fade" id="addGuestModal" tabindex="-1" role="dialog" aria-labelledby="addGuestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGuestModalLabel">Adicionar Convidados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addGuestForm" method="POST" action="{{ route('convidados.store', $reuniao->id) }}">
                    @csrf
    
                    <div id="guest-fields-container">
                        <div class="guest-fields">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" name="convidado[0][nome]" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="funcao">Funcao</label>
                                    <input type="text" class="form-control" name="convidado[0][funcao]" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="area">Area</label>
                                    <input type="text" class="form-control" name="convidado[0][area]"  required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="assinatura">Assinatura</label>
                                <textarea type="text" name="convidado[0][assinatura]" readonly class="form-control">void</textarea>
                            </div>
                            <button type="button" class="btn btn-danger remove-guest-btn">Remover</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary mb-3" id="addMoreGuestsBtn">Adicionar mais um Convidado</button>
                    <button type="submit" class="btn btn-success">Adicionar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectedCheckbox = null;

        document.querySelectorAll('.presence-checkbox').forEach(checkbox => {
            checkbox.addEventListener('click', function(e) {
                e.preventDefault();
                selectedCheckbox = this;
                document.getElementById('participante_id').value = selectedCheckbox.getAttribute('data-participante-id');
                $('#passwordModal').modal('show');
            });
        });

        document.getElementById('verifyPasswordBtn').addEventListener('click', function() {
            const password = document.getElementById('modal-password').value;
            document.getElementById('password').value = password;
            document.getElementById('submitBtn').click();
        });

        document.getElementById('addMoreGuestsBtn').addEventListener('click', function() {
            const container = document.getElementById('guest-fields-container');
            const index = container.getElementsByClassName('guest-fields').length;
            const guestFields = document.createElement('div');
            guestFields.classList.add('guest-fields');
            guestFields.innerHTML = `
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="convidado[${index}][nome]" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="funcao">Funcao</label>
                        <input type="text" class="form-control" name="convidado[${index}][funcao]" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="area">Area</label>
                        <input type="text" class="form-control" name="convidado[${index}][area]" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="assinatura">Assinatura</label>
                    <textarea type="text" name="convidado[${index}][assinatura]" readonly class="form-control">void</textarea>
                </div>
                <button type="button" class="btn btn-danger remove-guest-btn">Remover</button>
            `;
            container.appendChild(guestFields);

            // Adiciona evento de clique ao botão remover
            guestFields.querySelector('.remove-guest-btn').addEventListener('click', function() {
                guestFields.remove();
            });
        });

        // Adiciona evento de clique ao botão remover inicial
        document.querySelectorAll('.remove-guest-btn').forEach(button => {
            button.addEventListener('click', function() {
                button.closest('.guest-fields').remove();
            });
        });
    });
</script>
@endsection

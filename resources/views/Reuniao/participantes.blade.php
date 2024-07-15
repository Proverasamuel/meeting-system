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
                    <th>Presente</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participantes as $participante)
                <tr>
                    <td>{{ $participante->colaborador->name }}</td>
                    <td>
                        <input type="checkbox" class="presence-checkbox" data-participante-id="{{ $participante->id }}" {{ $participante->presente ? 'checked' : '' }}>
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
    });
</script>
@endsection

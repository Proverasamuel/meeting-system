<!-- resources/views/objetivos/create.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Create Objetivo</h1>
<form action="{{ route('objetivos.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="reuniao_id">Reuniao</label>
        <select name="reuniao_id" id="reuniao_id" class="form-control">
            @foreach($reunioes as $reuniao)
            <option value="{{ $reuniao->id }}">{{ $reuniao->titulo }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

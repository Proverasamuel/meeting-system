<!-- resources/views/Reuniao/create.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Create Meeting</h1>
<form action="{{ route('reuniao.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="titulo" id="title" class="form-control">
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="data" id="date" class="form-control">
    </div>
    <label for="nivel">Nivel</label>
    <select class="form-control" id="nivel" name="nivel" placeholder="Selecione o nivel" required>
        <option value="">Selecione o nível</option>
        <option value="Tatico">Tatico</option>
        <option value="Operacional">Operacional</option>
    </select>
    <div class="form-group">
        <label for="hora_inicio">Inicio</label>
        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control">
    </div>
    <div class="form-group">
        <label for="hora_fim">Termino</label>
        <input type="time" name="hora_fim" id="hora_fim" class="form-control">
    </div>
    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" name="local" id="location" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
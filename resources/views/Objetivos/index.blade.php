<!-- resources/views/objetivos/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Objetivos</h1>
<a href="{{ route('objetivos.create') }}" class="btn btn-primary mb-2">Create Objetivo</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Reuniao</th>
            <th>Descrição</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($objetivos as $objetivo)
        <tr>
            <td>{{ $objetivo->id }}</td>
            <td>{{ $objetivo->reuniao->titulo }}</td>
            <td>{{ $objetivo->descricao }}</td>
            <td>
                <a href="{{ route('objetivos.show', $objetivo->id) }}" class="btn btn-info">View</a>
                <a href="{{ route('objetivos.edit', $objetivo->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('objetivos.destroy', $objetivo->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

<!-- resources/views/decisions/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Decisions</h1>
<a href="{{ route('decisions.create') }}" class="btn btn-primary mb-2">Create Decision</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Meeting</th>
            <th>Description</th>
            <th>Responsible</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($decisions as $decision)
        <tr>
            <td>{{ $decision->id }}</td>
            <td>{{ $decision->meeting->title }}</td>
            <td>{{ $decision->description }}</td>
            <td>{{ $decision->responsible->name }}</td>
            <td>
                <a href="{{ route('decisions.show', $decision->id) }}" class="btn btn-info">View</a>
                <a href="{{ route('decisions.edit', $decision->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('decisions.destroy', $decision->id) }}" method="POST" style="display:inline;">
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

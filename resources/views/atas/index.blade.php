<!-- resources/views/minutes/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Minutes</h1>
<a href="{{ route('minutes.create') }}" class="btn btn-primary mb-2">Create Minutes</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Meeting</th>
            <th>Status</th>
            <th>Responsible</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($minutes as $minute)
        <tr>
            <td>{{ $minute->id }}</td>
            <td>{{ $minute->meeting->title }}</td>
            <td>{{ $minute->status }}</td>
            <td>{{ $minute->responsible->name }}</td>
            <td>
                <a href="{{ route('minutes.show', $minute->id) }}" class="btn btn-info">View</a>
                <a href="{{ route('minutes.edit', $minute->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('minutes.destroy', $minute->id) }}" method="POST" style="display:inline;">
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

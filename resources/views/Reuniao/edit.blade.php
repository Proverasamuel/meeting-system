<!-- resources/views/Reuniao/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Edit Meeting</h1>
<form action="{{ route('reuniao.update', $reuniao->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="titulo" id="title" class="form-control" value="{{ $reuniao->titulo }}">
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="data" id="date" class="form-control" value="{{ $reuniao->data }}">
    </div>
    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" name="local" id="location" class="form-control" value="{{ $reuniao->local }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
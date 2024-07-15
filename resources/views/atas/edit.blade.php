<!-- resources/views/minutes/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Edit Minutes</h1>
<form action="{{ route('minutes.update', $minute->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="meeting_id">Meeting</label>
        <select name="meeting_id" id="meeting_id" class="form-control">
            @foreach($meetings as $meeting)
            <option value="{{ $meeting->id }}" {{ $minute->meeting_id == $meeting->id ? 'selected' : '' }}>{{ $meeting->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <input type="text" name="status" id="status" class="form-control" value="{{ $minute->status }}">
    </div>
    <div class="form-group">
        <label for="responsible_id">Responsible</label>
        <select name="responsible_id" id="responsible_id" class="form-control">
            @foreach($participants as $participant)
            <option value="{{ $participant->id }}" {{ $minute->responsible_id == $participant->id ? 'selected' : '' }}>{{ $participant->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

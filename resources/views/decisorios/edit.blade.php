<!-- resources/views/decisions/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Edit Decision</h1>
<form action="{{ route('decisions.update', $decision->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="meeting_id">Meeting</label>
        <select name="meeting_id" id="meeting_id" class="form-control">
            @foreach($meetings as $meeting)
            <option value="{{ $meeting->id }}" {{ $decision->meeting_id == $meeting->id ? 'selected' : '' }}>{{ $meeting->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ $decision->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="responsible_id">Responsible</label>
        <select name="responsible_id" id="responsible_id" class="form-control">
            @foreach($participants as $participant)
            <option value="{{ $participant->id }}" {{ $decision->responsible_id == $participant->id ? 'selected' : '' }}>{{ $participant->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

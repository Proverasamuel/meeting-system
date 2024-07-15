<!-- resources/views/minutes/show.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Minutes Details</h1>
<div class="card">
    <div class="card-header">
        {{ $minute->meeting->title }}
    </div>
    <div class="card-body">
        <h5 class="card-title">Status: {{ $minute->status }}</h5>
        <p class="card-text">Responsible: {{ $minute->responsible->name }}</p>
    </div>
</div>
<a href="{{ route('minutes.index') }}" class="btn btn-secondary mt-2">Back</a>
@endsection

<!-- resources/views/decisions/show.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Decision Details</h1>
<div class="card">
    <div class="card-header">
        {{ $decision->meeting->title }}
    </div>
    <div class="card-body">
        <h5 class="card-title">Description: {{ $decision->description }}</h5>
        <p class="card-text">Responsible: {{ $decision->responsible->name }}</p>
    </div>
</div>
<a href="{{ route('decisions.index') }}" class="btn btn-secondary mt-2">Back</a>
@endsection

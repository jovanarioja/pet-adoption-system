@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h4>Hello, {{ auth()->user()->name }}!</h4>
            <p class="text-muted">You are logged in.</p>
            <a href="{{ route('pets.index') }}" class="btn btn-primary">Manage Pets</a>
        </div>
    </div>
@endsection

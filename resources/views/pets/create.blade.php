@extends('layouts.app')

@section('title', 'Add Pet')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h4 class="mb-3">Add Pet</h4>
            @include('pets._form', ['action' => route('pets.store'), 'submitLabel' => 'Save Pet'])
        </div>
    </div>
@endsection

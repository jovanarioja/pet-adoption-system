@extends('layouts.app')

@section('title', 'Edit Pet')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h4 class="mb-3">Edit Pet</h4>
            @include('pets._form', [
                'action' => route('pets.update', $pet),
                'method' => 'PUT',
                'submitLabel' => 'Update Pet',
            ])
        </div>
    </div>
@endsection

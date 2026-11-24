@extends('layouts.app')

@section('title', $pet->name)

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h4>{{ $pet->name }}</h4>
            <dl class="row mb-0">
                <dt class="col-sm-3">Species</dt><dd class="col-sm-9">{{ $pet->species }}</dd>
                <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ $pet->status }}</dd>
                <dt class="col-sm-3">Shelter</dt><dd class="col-sm-9">{{ $pet->shelter->shelter_name ?? '—' }}</dd>
                <dt class="col-sm-3">Events</dt>
                <dd class="col-sm-9">
                    @forelse ($pet->adoptionEvents as $event)
                        <div>{{ $event->event_name }} ({{ $event->event_date->format('M d, Y') }})</div>
                    @empty
                        —
                    @endforelse
                </dd>
            </dl>
            <a href="{{ route('pets.index') }}" class="btn btn-link px-0 mt-3">← Back</a>
        </div>
    </div>
@endsection

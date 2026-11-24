@extends('layouts.app')

@section('title', 'Pets')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Pets</h4>
        <a href="{{ route('pets.create') }}" class="btn btn-primary">+ Add Pet</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Species</th>
                    <th>Status</th>
                    <th>Shelter</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($pets as $pet)
                    <tr>
                        <td>{{ $pet->name }}</td>
                        <td>{{ $pet->species }}</td>
                        <td>
                            <span class="badge bg-{{ $pet->status === 'Available' ? 'success' : ($pet->status === 'Pending' ? 'warning' : 'secondary') }}">
                                {{ $pet->status }}
                            </span>
                        </td>
                        <td>{{ $pet->shelter->shelter_name ?? '—' }}</td>
                        <td class="text-end">
                            <a href="{{ route('pets.show', $pet) }}" class="btn btn-sm btn-outline-secondary">View</a>
                            <a href="{{ route('pets.edit', $pet) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('pets.destroy', $pet) }}" class="d-inline"
                                  onsubmit="return confirm('Delete this pet?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" data-loading-text="Deleting...">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No pets yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $pets->links() }}</div>
@endsection

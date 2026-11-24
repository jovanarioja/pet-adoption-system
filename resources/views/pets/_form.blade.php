{{-- Shared form. Expects: $action, $submitLabel, $shelters, optional $pet, optional $method --}}
<form method="POST" action="{{ $action }}" novalidate>
    @csrf
    @if (($method ?? 'POST') !== 'POST')
        @method($method)
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $pet->name ?? '') }}"
               class="form-control @error('name') is-invalid @enderror" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="species" class="form-label">Species</label>
        <input type="text" id="species" name="species" value="{{ old('species', $pet->species ?? '') }}"
               class="form-control @error('species') is-invalid @enderror" required>
        @error('species') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
            @foreach (['Available', 'Pending', 'Adopted'] as $status)
                <option value="{{ $status }}" @selected(old('status', $pet->status ?? 'Available') === $status)>{{ $status }}</option>
            @endforeach
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
        <label for="shelter_id" class="form-label">Shelter</label>
        <select id="shelter_id" name="shelter_id" class="form-select @error('shelter_id') is-invalid @enderror">
            <option value="">— None —</option>
            @foreach ($shelters as $shelter)
                <option value="{{ $shelter->id }}" @selected((string) old('shelter_id', $pet->shelter_id ?? '') === (string) $shelter->id)>
                    {{ $shelter->shelter_name }}
                </option>
            @endforeach
        </select>
        @error('shelter_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary" data-loading-text="Saving...">{{ $submitLabel }}</button>
    <a href="{{ route('pets.index') }}" class="btn btn-link">Cancel</a>
</form>

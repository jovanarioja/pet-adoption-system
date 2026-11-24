<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('shelter')->latest()->paginate(10);
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        $shelters = Shelter::orderBy('shelter_name')->get();
        return view('pets.create', compact('shelters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shelter_id' => ['nullable', 'integer', 'exists:shelters,id'],
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'string', 'max:100'],
            'status' => ['required', Rule::in(['Available', 'Adopted', 'Pending'])],
        ]);

        Pet::create($validated);

        return redirect()->route('pets.index')->with('success', 'Pet added successfully.');
    }

    public function show(Pet $pet)
    {
        $pet->load(['shelter', 'adoptionEvents']);
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        $shelters = Shelter::orderBy('shelter_name')->get();
        return view('pets.edit', compact('pet', 'shelters'));
    }

    public function update(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'shelter_id' => ['nullable', 'integer', 'exists:shelters,id'],
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'string', 'max:100'],
            'status' => ['required', Rule::in(['Available', 'Adopted', 'Pending'])],
        ]);

        $pet->update($validated);

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully.');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully.');
    }
}

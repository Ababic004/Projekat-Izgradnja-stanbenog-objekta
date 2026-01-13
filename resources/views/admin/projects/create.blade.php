@extends('layouts.admin')

@section('title', 'Novi projekat')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Novi projekat</h1>

<form method="POST" action="{{ route('admin.projects.store') }}" class="max-w-xl space-y-4">
    @csrf

    <div>
        <label class="block text-sm font-medium">Naziv</label>
        <input name="name" required class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block text-sm font-medium">Lokacija</label>
        <input name="location" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block text-sm font-medium">Status</label>
        <select name="status" class="w-full border rounded px-3 py-2">
            <option value="planning">Planning</option>
            <option value="in_progress">In progress</option>
            <option value="done">Done</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium">Budžet (€)</label>
        <input type="number" name="budget_eur" value="0" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <button class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">
            Sačuvaj
        </button>

        <a href="{{ route('admin.projects.index') }}" class="ml-4 text-gray-600">
            Nazad
        </a>
    </div>
</form>
@endsection

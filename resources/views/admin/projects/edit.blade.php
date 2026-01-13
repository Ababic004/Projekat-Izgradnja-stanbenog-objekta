@extends('layouts.admin')

@section('title', 'Izmeni projekat')

@section('content')
<h1 class="text-xl font-semibold mb-4 text-black">Izmeni projekat</h1>

@if ($errors->any())
    <div class="mb-4 p-3 rounded border bg-white text-black">
        <div class="font-semibold mb-2">Greške:</div>
        <ul class="list-disc ml-5 text-sm">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.projects.update', $project) }}"
      class="bg-white border rounded-lg p-4 space-y-4 text-black">
    @csrf
    @method('PUT')

    <div>
        <label class="text-sm font-medium">Naziv *</label>
        <input name="name" value="{{ old('name', $project->name) }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="text-sm font-medium">Lokacija</label>
        <input name="location" value="{{ old('location', $project->location) }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="text-sm font-medium">Status *</label>
        <select name="status" class="w-full border rounded px-3 py-2" required>
            <option value="planning" @selected(old('status', $project->status)==='planning')>planning</option>
            <option value="in_progress" @selected(old('status', $project->status)==='in_progress')>in_progress</option>
            <option value="done" @selected(old('status', $project->status)==='done')>done</option>
        </select>
    </div>

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-medium">Start date</label>
            <input type="date" name="start_date"
                   value="{{ old('start_date', optional($project->start_date)->format('Y-m-d')) }}"
                   class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="text-sm font-medium">End date</label>
            <input type="date" name="end_date"
                   value="{{ old('end_date', optional($project->end_date)->format('Y-m-d')) }}"
                   class="w-full border rounded px-3 py-2">
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-medium">Budžet (€)</label>
            <input type="number" min="0" name="budget_eur"
                   value="{{ old('budget_eur', $project->budget_eur ?? 0) }}"
                   class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="text-sm font-medium">Progres (%)</label>
            <input type="number" min="0" max="100" name="progress"
                   value="{{ old('progress', $project->progress ?? 0) }}"
                   class="w-full border rounded px-3 py-2">
        </div>
    </div>

    <div class="flex gap-2">
        <button class="px-4 py-2 bg-gray-200 text-black border border-gray-400 rounded hover:bg-gray-300">
            Sačuvaj izmene
        </button>

        <a href="{{ route('admin.projects.index') }}"
           class="px-4 py-2 bg-white text-black border-2 border-black rounded hover:bg-gray-100">
            Nazad
        </a>
    </div>
</form>
@endsection
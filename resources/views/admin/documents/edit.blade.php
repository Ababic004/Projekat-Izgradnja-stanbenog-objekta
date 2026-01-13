@extends('layouts.admin')

@section('title', 'Izmeni dokument')

@section('content')
<h1 class="text-xl font-semibold mb-4 text-black">Izmeni dokument</h1>

{{-- Greške validacije --}}
@if ($errors->any())
    <div class="mb-4 p-3 border rounded bg-white text-black">
        <div class="font-semibold mb-2">Greške:</div>
        <ul class="list-disc ml-5 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST"
      action="{{ route('admin.documents.update', $document) }}"
      class="space-y-4 text-black bg-white border rounded p-4 max-w-xl">

    @csrf
    @method('PUT')

    {{-- Projekat --}}
    <div>
        <label class="block text-sm font-medium mb-1">Projekat</label>
        <select name="project_id" class="w-full border p-2 rounded">
            @foreach($projects as $project)
                <option value="{{ $project->id }}"
                    @selected(old('project_id', $document->project_id) == $project->id)>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Naslov --}}
    <div>
        <label class="block text-sm font-medium mb-1">Naziv dokumenta *</label>
        <input name="title"
               value="{{ old('title', $document->title) }}"
               class="w-full border p-2 rounded"
               required>
    </div>

    {{-- Tip --}}
    <div>
        <label class="block text-sm font-medium mb-1">Tip dokumenta</label>
        <input name="type"
               value="{{ old('type', $document->type) }}"
               placeholder="npr. ugovor, dozvola"
               class="w-full border p-2 rounded">
    </div>

    {{-- Datum --}}
    <div>
        <label class="block text-sm font-medium mb-1">Datum izdavanja</label>
        <input type="date"
               name="issued_at"
               value="{{ old('issued_at', optional($document->issued_at)->format('Y-m-d')) }}"
               class="w-full border p-2 rounded">
    </div>

    {{-- Dugmad --}}
    <div class="flex gap-2 pt-2">
        <button type="submit"
                class="px-4 py-2 bg-gray-200 text-black font-semibold border border-gray-400 rounded hover:bg-gray-300">
            Sačuvaj izmene
        </button>

        <a href="{{ route('admin.documents.index') }}"
           class="px-4 py-2 bg-white text-black border-2 border-black rounded hover:bg-gray-100">
            Nazad
        </a>
    </div>
</form>
@endsection

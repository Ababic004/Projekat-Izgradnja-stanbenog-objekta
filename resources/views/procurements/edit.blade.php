@extends('layouts.admin')

@section('title', 'Izmena nabavke')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 border rounded">

    <h1 class="text-xl font-semibold mb-4">Izmena nabavke</h1>

    <form method="POST"
          action="{{ route('procurements.update', $procurement) }}"
          class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm mb-1">Naziv</label>
            <input name="title"
                   value="{{ $procurement->title }}"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block text-sm mb-1">Dobavljač</label>
            <input name="supplier"
                   value="{{ $procurement->supplier }}"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block text-sm mb-1">Opis</label>
            <textarea name="description"
                      class="w-full border rounded px-3 py-2"
                      rows="3">{{ $procurement->description }}</textarea>
        </div>

        <div>
            <label class="block text-sm mb-1">Iznos (€)</label>
            <input type="number" step="0.01"
                   name="total_amount"
                   value="{{ $procurement->total_amount }}"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block text-sm mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="draft" @selected($procurement->status === 'draft')>Draft</option>
                <option value="submitted" @selected($procurement->status === 'submitted')>Submitted</option>
            </select>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('procurements.index') }}"
               class="px-4 py-2 border rounded">
                Nazad
            </a>
            <button class="px-4 py-2 border rounded">
                Sačuvaj izmene
            </button>
        </div>
    </form>

</div>
@endsection
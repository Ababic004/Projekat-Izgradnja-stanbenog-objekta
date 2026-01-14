@extends('layouts.admin')

@section('title', 'Nova nabavka')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 border rounded">

    <h1 class="text-xl font-semibold mb-4">Nova nabavka</h1>

    <form method="POST" action="{{ route('procurements.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm mb-1">Naziv</label>
            <input name="title" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Dobavljač</label>
            <input name="supplier" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Opis</label>
            <textarea name="description"
                      class="w-full border rounded px-3 py-2"
                      rows="3"></textarea>
        </div>

        <div>
            <label class="block text-sm mb-1">Iznos (€)</label>
            <input type="number" step="0.01"
                   name="total_amount"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('procurements.index') }}"
               class="px-4 py-2 border rounded">
                Nazad
            </a>
            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Sačuvaj
            </button>
        </div>
    </form>

</div>
@endsection

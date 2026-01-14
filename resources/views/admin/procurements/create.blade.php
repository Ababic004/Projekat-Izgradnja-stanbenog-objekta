@extends('layouts.admin')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Nova nabavka</h1>

        <a href="{{ route('admin.procurements.index') }}"
           class="text-sm text-gray-600 hover:text-gray-900">
            ← Nazad
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.procurements.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Naziv</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Dobavljač</label>
                <input type="text" name="supplier" value="{{ old('supplier') }}"
                       class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('supplier') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Opis</label>
                <textarea name="description" rows="4"
                          class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Iznos (€)</label>
                    <input type="number" step="0.01" name="total_amount" value="{{ old('total_amount') }}"
                           class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                    @error('total_amount') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status"
                            class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        @php $s = old('status', 'draft'); @endphp
                        <option value="draft" {{ $s==='draft' ? 'selected' : '' }}>Draft</option>
                        <option value="submitted" {{ $s==='submitted' ? 'selected' : '' }}>Submitted</option>
                        <option value="approved" {{ $s==='approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $s==='rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">
                    Sačuvaj
                </button>

                <a href="{{ route('admin.procurements.index') }}"
                   class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">
                    Otkaži
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

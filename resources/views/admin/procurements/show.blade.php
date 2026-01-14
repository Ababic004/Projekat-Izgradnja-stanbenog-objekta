@extends('layouts.admin')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">{{ $procurement->title }}</h1>
            <p class="text-sm text-gray-600 mt-1">Dobavljač: {{ $procurement->supplier }}</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.procurements.edit', $procurement) }}"
               class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">
                Edit
            </a>

            <form action="{{ route('admin.procurements.destroy', $procurement) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        onclick="return confirm('Obrisati nabavku?')"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Status</span>
            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                @if($procurement->status === 'approved') bg-green-100 text-green-800
                @elseif($procurement->status === 'submitted') bg-blue-100 text-blue-800
                @elseif($procurement->status === 'rejected') bg-red-100 text-red-800
                @else bg-gray-100 text-gray-800
                @endif">
                {{ ucfirst($procurement->status) }}
            </span>
        </div>

        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Iznos</span>
            <span class="text-sm font-medium text-gray-900">{{ number_format($procurement->total_amount, 2) }} €</span>
        </div>

        <div>
            <span class="text-sm text-gray-500">Opis</span>
            <p class="mt-1 text-sm text-gray-800">
                {{ $procurement->description ?: '—' }}
            </p>
        </div>

        <div class="pt-2">
            <a href="{{ route('admin.procurements.index') }}"
               class="text-sm text-gray-600 hover:text-gray-900">
                ← Nazad na listu
            </a>
        </div>
    </div>
</div>
@endsection

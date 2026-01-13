@extends('layouts.admin')

@section('title', 'Projekti')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Projekti</h1>


    <a href="{{ route('admin.projects.create') }}"
       class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">
        + Novi projekat
    </a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-100 text-sm">
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Naziv</th>
                <th class="px-4 py-2">Lokacija</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Progress</th>
                <th class="px-4 py-2">Budžet (€)</th>
                <th class="px-4 py-2">Akcije</th>
            </tr>

        </thead>

        <tbody>
        @forelse($projects as $project)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $project->id }}</td>
                <td class="px-4 py-2 font-medium">{{ $project->name }}</td>
                <td class="px-4 py-2">{{ $project->location }}</td>
                <td class="px-4 py-2">{{ ucfirst($project->status) }}</td>
                <td class="px-4 py-2">{{ $project->progress }}%</td>
                <td class="px-4 py-2">{{ number_format($project->budget_eur, 0, ',', '.') }}</td>
                <td class="px-4 py-2">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.projects.edit', $project) }}"
                        class="px-3 py-1 bg-gray-200 text-black border border-gray-400 rounded hover:bg-gray-300">
                            Izmeni
                        </a>

                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                            onsubmit="return confirm('Obrisati projekat?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1 bg-white text-black border-2 border-black rounded hover:bg-gray-100">
                                Obriši
                            </button>
                        </form>
                    </div>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                    Nema projekata.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection


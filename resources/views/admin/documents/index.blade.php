@extends('layouts.admin')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-xl font-semibold text-black">Dokumenta</h1>

    <a href="{{ route('admin.documents.create') }}"
       class="px-4 py-2 bg-white text-black">
        + Novi dokument
    </a>
</div>

<table class="w-full bg-white border text-black">
    <thead>
        <tr class="bg-gray-100 text-sm">
            <th class="p-2">Naslov</th>
            <th class="p-2">Projekat</th>
            <th class="p-2">Tip</th>
            <th class="p-2">Datum</th>
            <th class="p-2">Akcije</th>
        </tr>
    </thead>
    <tbody>
        @forelse($documents as $doc)
        <tr class="border-t text-sm">
            <td class="p-2">{{ $doc->title }}</td>
            <td class="p-2">{{ $doc->project->name }}</td>
            <td class="p-2">{{ $doc->type }}</td>
            <td class="p-2">{{ $doc->issued_at }}</td>
            <td class="p-2 flex gap-2">
                <a href="{{ route('admin.documents.edit', $doc) }}"
                   class="px-2 py-1 border border-black">Izmeni</a>

                <form method="POST" action="{{ route('admin.documents.destroy', $doc) }}">
                    @csrf @method('DELETE')
                    <button class="px-2 py-1 border border-black">Obriši</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="p-4 text-center text-gray-500">
                Nema dokumenata
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection

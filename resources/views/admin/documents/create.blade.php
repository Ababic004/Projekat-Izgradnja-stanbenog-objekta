@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-semibold mb-4 text-black">Novi dokument</h1>

<form method="POST" action="{{ route('admin.documents.store') }}" class="space-y-4 text-black">
    @csrf

    <select name="project_id" class="w-full border p-2">
        @foreach($projects as $project)
            <option value="{{ $project->id }}">{{ $project->name }}</option>
        @endforeach
    </select>

    <input name="title" placeholder="Naziv dokumenta" class="w-full border p-2">
    <input name="type" placeholder="Tip (ugovor, dozvola)" class="w-full border p-2">
    <input type="date" name="issued_at" class="w-full border p-2">

    <button class="px-4 py-2 bg-gray-200 text-black border border-gray-400 rounded">
        Sačuvaj
    </button>
</form>
@endsection

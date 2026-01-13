
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-xl font-semibold mb-4">Dashboard</h1>

<div class="grid md:grid-cols-4 gap-4">
    <div class="bg-white border rounded-lg p-4">
        <div class="text-sm text-gray-500">Projekti</div>
        <div class="text-2xl font-semibold">0</div>
    </div>

    <div class="bg-white border rounded-lg p-4">
        <div class="text-sm text-gray-500">Nekretnine</div>
        <div class="text-2xl font-semibold">0</div>
    </div>

    <div class="bg-white border rounded-lg p-4">
        <div class="text-sm text-gray-500">Dokumenti</div>
        <div class="text-2xl font-semibold">0</div>
    </div>

    <div class="bg-white border rounded-lg p-4">
        <div class="text-sm text-gray-500">Nabavke</div>
        <div class="text-2xl font-semibold">0</div>
    </div>
</div>
<div class="mt-6 flex flex-wrap gap-3">
    <a href="{{ route('admin.projects.index') }}"
       class="px-4 py-2 bg-gray-200 text-black border border-gray-400 rounded hover:bg-gray-300">
        Projekti 
    </a>

    <a href="{{ route('admin.units.index') }}"
       class="px-4 py-2 bg-gray-200 text-black border border-gray-400 rounded hover:bg-gray-300">
        Nekretnine 
    </a>

    <a href="{{ route('admin.documents.index') }}"
       class="px-4 py-2 bg-gray-200 text-black border border-gray-400 rounded hover:bg-gray-300">
        Dokumenti 
    </a>

    <a href="{{ route('admin.procurements.index') }}"
       class="px-4 py-2 bg-gray-200 text-black border border-gray-400 rounded hover:bg-gray-300">
        Nabavke 
    </a>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Pregled nabavke')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 border rounded">

    <h1 class="text-xl font-semibold mb-4">Pregled nabavke</h1>

    <div class="space-y-2 text-sm">
        <div><strong>Naziv:</strong> {{ $procurement->title }}</div>
        <div><strong>Dobavljač:</strong> {{ $procurement->supplier }}</div>
        <div><strong>Opis:</strong> {{ $procurement->description ?? '—' }}</div>
        <div><strong>Iznos:</strong> {{ number_format($procurement->total_amount, 2) }} €</div>
        <div><strong>Status:</strong> {{ ucfirst($procurement->status) }}</div>
    </div>

    <div class="mt-6">
        <a href="{{ route('procurements.index') }}"
           class="px-4 py-2 border rounded">
            Nazad
        </a>
    </div>

</div>
@endsection
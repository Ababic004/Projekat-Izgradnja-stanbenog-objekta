@extends('layouts.admin')

@section('title', 'Moje nabavke')

@section('content')
<div class="max-w-6xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Moje nabavke</h1>

        <a href="{{ route('procurements.create') }}"
           class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">
            + Nova nabavka
        </a>
    </div>

    @if($procurements->isEmpty())
        <div class="bg-white p-6 border rounded">
            Nemate unetih zahteva za nabavku.
        </div>
    @else
        <div class="bg-white border rounded overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Naziv</th>
                        <th class="px-4 py-3 text-left">Dobavljač</th>
                        <th class="px-4 py-3 text-right">Iznos (€)</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-right">Akcije</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($procurements as $procurement)
                        <tr>
                            <td class="px-4 py-3">{{ $procurement->title }}</td>
                            <td class="px-4 py-3">{{ $procurement->supplier }}</td>
                            <td class="px-4 py-3 text-right">
                                {{ number_format($procurement->total_amount, 2) }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                {{ ucfirst($procurement->status) }}
                            </td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('procurements.show', $procurement) }}"
                                   class="text-blue-600 hover:underline">
                                    View
                                </a>

                                <a href="{{ route('procurements.edit', $procurement) }}"
                                   class="text-indigo-600 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('procurements.destroy', $procurement) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Obrisati zahtev?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection

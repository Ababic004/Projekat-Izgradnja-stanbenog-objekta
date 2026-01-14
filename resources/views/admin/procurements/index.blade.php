@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            Nabavke
        </h1>

        <a href="{{ route('admin.procurements.create') }}"
            class="!inline-flex !items-center !px-4 !py-2 !rounded-lg
                    !bg-indigo-600 !text-white !font-medium !text-sm
                    hover:!bg-indigo-700 transition">
                + Nova nabavka
        </a>


    </div>
     


    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Naziv</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dobavljač</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Iznos</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Akcije</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($procurements as $procurement)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $procurement->title }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $procurement->supplier }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ number_format($procurement->total_amount, 2) }} €
                        </td>

                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'draft' => 'bg-gray-100 text-gray-800',
                                    'submitted' => 'bg-blue-100 text-blue-800',
                                    'approved' => 'bg-green-100 text-green-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                ];
                            @endphp

                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                {{ $statusClasses[$procurement->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($procurement->status) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.procurements.show', $procurement) }}"
                               class="text-indigo-600 hover:text-indigo-900 text-sm">
                                View
                            </a>

                            <a href="{{ route('admin.procurements.edit', $procurement) }}"
                               class="text-gray-600 hover:text-gray-900 text-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.procurements.destroy', $procurement) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Obrisati nabavku?')"
                                        class="text-red-600 hover:text-red-800 text-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                            Nema unetih nabavki.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
    {{ $procurements->links() }}
</div>
    </div>
</div>
@endsection

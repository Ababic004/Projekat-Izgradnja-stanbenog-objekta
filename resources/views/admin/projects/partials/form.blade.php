@php
  $v = fn($key, $default='') => old($key, $project?->$key ?? $default);
@endphp

<div>
    <label class="text-sm text-gray-600">Naziv *</label>
    <input name="name" value="{{ $v('name') }}" class="mt-1 w-full rounded-md border-gray-200 text-sm">
    @error('name') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="text-sm text-gray-600">Lokacija</label>
        <input name="location" value="{{ $v('location') }}" class="mt-1 w-full rounded-md border-gray-200 text-sm">
        @error('location') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="text-sm text-gray-600">Status *</label>
        <select name="status" class="mt-1 w-full rounded-md border-gray-200 text-sm">
            @foreach(['planning'=>'Planiranje','in_progress'=>'U toku','finished'=>'Završen'] as $key=>$label)
                <option value="{{ $key }}" @selected($v('status','planning')===$key)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="text-sm text-gray-600">Početak</label>
        <input type="date" name="start_date" value="{{ $v('start_date') }}" class="mt-1 w-full rounded-md border-gray-200 text-sm">
        @error('start_date') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="text-sm text-gray-600">Završetak</label>
        <input type="date" name="end_date" value="{{ $v('end_date') }}" class="mt-1 w-full rounded-md border-gray-200 text-sm">
        @error('end_date') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="text-sm text-gray-600">Budžet (€)</label>
        <input type="number" name="budget_eur" value="{{ $v('budget_eur') }}" class="mt-1 w-full rounded-md border-gray-200 text-sm">
        @error('budget_eur') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="text-sm text-gray-600">Napredak (%) *</label>
        <input type="number" name="progress_percent" value="{{ $v('progress_percent', 0) }}" class="mt-1 w-full rounded-md border-gray-200 text-sm">
        @error('progress_percent') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>
</div>

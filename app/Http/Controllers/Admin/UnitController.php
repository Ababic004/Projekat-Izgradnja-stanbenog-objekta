<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Project;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();

        $units = Unit::query()
            ->with('project:id,name')
            ->when($q, function ($query) use ($q) {
                $query->where('code', 'like', "%{$q}%")
                      ->orWhereHas('project', fn($p) => $p->where('name', 'like', "%{$q}%"));
            })
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('admin.units.index', compact('units', 'q'));
    }

    public function create()
    {
        $projects = Project::query()->orderBy('name')->get(['id','name']);
        return view('admin.units.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => ['required','exists:projects,id'],
            'code' => ['required','string','max:30'],
            'floor' => ['required','integer','min:0','max:200'],
            'area_m2' => ['required','integer','min:10','max:2000'],
            'rooms' => ['required','integer','min:1','max:50'],
            'price_eur' => ['required','integer','min:0'],
            'status' => ['required','in:available,reserved,sold'],
        ]);

        Unit::create($data);

        return redirect()->route('admin.units.index')->with('success', 'Nekretnina je dodata.');
    }

    public function edit(Unit $unit)
    {
        $projects = Project::query()->orderBy('name')->get(['id','name']);
        return view('admin.units.edit', compact('unit','projects'));
    }

    public function update(Request $request, Unit $unit)
    {
        $data = $request->validate([
            'project_id' => ['required','exists:projects,id'],
            'code' => ['required','string','max:30'],
            'floor' => ['required','integer','min:0','max:200'],
            'area_m2' => ['required','integer','min:10','max:2000'],
            'rooms' => ['required','integer','min:1','max:50'],
            'price_eur' => ['required','integer','min:0'],
            'status' => ['required','in:available,reserved,sold'],
        ]);

        $unit->update($data);

        return redirect()->route('admin.units.index')->with('success', 'Nekretnina je izmenjena.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('admin.units.index')->with('success', 'Nekretnina je obrisana.');
    }

    public function show(Unit $unit)
    {
        $unit->load('project:id,name');
        return view('admin.units.show', compact('unit'));
    }

    // Non-admin use case (lista kartica / tabela)
    public function publicIndex()
    {
        $units = Unit::query()
            ->with('project:id,name')
            ->orderByDesc('id')
            ->paginate(12);

        return view('app.units_public', compact('units'));
    }
}


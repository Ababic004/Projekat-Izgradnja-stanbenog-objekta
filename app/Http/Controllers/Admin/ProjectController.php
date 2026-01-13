<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::query()
        ->orderByDesc('id')
        ->paginate(10);

    return view('admin.projects.index', compact('projects')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'name'       => ['required', 'string', 'max:255'],
        'location'   => ['nullable', 'string', 'max:255'],
        'status'     => ['required', 'in:planning,in_progress,done'],
        'start_date' => ['nullable', 'date'],
        'end_date'   => ['nullable', 'date', 'after_or_equal:start_date'],
        'budget_eur' => ['nullable', 'integer', 'min:0'],
    ]);

    // Default vrednosti
    $data['budget_eur'] = $data['budget_eur'] ?? 0;
    $data['progress']   = 0;

    Project::create($data);

    return redirect()
        ->route('admin.projects.index')
        ->with('success', 'Projekat je dodat.');
}

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
    $data = $request->validate([
        'name'       => ['required', 'string', 'max:255'],
        'location'   => ['nullable', 'string', 'max:255'],
        'status'     => ['required', 'in:planning,in_progress,done'],
        'start_date' => ['nullable', 'date'],
        'end_date'   => ['nullable', 'date', 'after_or_equal:start_date'],
        'budget_eur' => ['nullable', 'integer', 'min:0'],
        'progress'   => ['nullable', 'integer', 'min:0', 'max:100'],
    ]);

    $data['budget_eur'] = $data['budget_eur'] ?? 0;
    $data['progress']   = $data['progress'] ?? 0;

    $project->update($data);

    return redirect()
        ->route('admin.projects.index')
        ->with('success', 'Projekat je izmenjen.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Projekat je obrisan.');
    }
}

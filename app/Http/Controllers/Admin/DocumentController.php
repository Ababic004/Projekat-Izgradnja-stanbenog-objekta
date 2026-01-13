<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Project;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('project')->latest()->paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $projects = Project::orderBy('name')->get();
        return view('admin.documents.create', compact('projects'));
    }

    public function store(Request $request)
    {
        Document::create($request->validate([
            'project_id' => 'required|exists:projects,id',
            'title'      => 'required|string|max:255',
            'type'       => 'nullable|string|max:255',
            'issued_at'  => 'nullable|date',
        ]));

        return redirect()->route('admin.documents.index');
    }

    public function edit(Document $document)
    {
        $projects = Project::orderBy('name')->get();
        return view('admin.documents.edit', compact('document', 'projects'));
    }

    public function update(Request $request, Document $document)
    {
        $document->update($request->validate([
            'project_id' => 'required|exists:projects,id',
            'title'      => 'required|string|max:255',
            'type'       => 'nullable|string|max:255',
            'issued_at'  => 'nullable|date',
        ]));

        return redirect()->route('admin.documents.index');
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('admin.documents.index');
    }
}

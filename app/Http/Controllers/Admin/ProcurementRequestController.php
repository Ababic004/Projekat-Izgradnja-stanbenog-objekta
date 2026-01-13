<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcurementRequestStoreRequest;
use App\Http\Requests\ProcurementRequestUpdateRequest;
use App\Models\Procurement;
use Illuminate\Http\Request;

class ProcurementRequestController extends Controller
{
    public function index()
    {
        $procurements = Procurement::all();

        return view('admin.procurements.index', [
            'procurements' => $procurements,
        ]);
    }

    public function create()
    {
        return view('admin.procurements.create');
    }

    public function store(ProcurementRequestStoreRequest $request)
    {
        Procurement::create($request->validated());

        return redirect()->route('admin.procurements.index');
    }

    public function show(Procurement $procurement)
    {
        return view('admin.procurements.show', [
            'procurement' => $procurement,
        ]);
    }

    public function edit(Procurement $procurement)
    {
        return view('admin.procurements.edit', [
            'procurement' => $procurement,
        ]);
    }

    public function update(ProcurementRequestUpdateRequest $request, Procurement $procurement)
    {
        $procurement->update($request->validated());

        return redirect()->route('admin.procurements.index');
    }

    public function destroy(Procurement $procurement)
    {
        $procurement->delete();

        return redirect()->route('admin.procurements.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Procurement;
use Illuminate\Http\Request;

class ProcurementController extends Controller
{
    
    public function index()
    {
        $procurements = Procurement::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('procurements.index', compact('procurements'));
    }

   
    public function create()
    {
        return view('procurements.create');
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'supplier'     => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'total_amount' => ['required', 'numeric', 'min:0'],
        ]);

        Procurement::create([
            ...$data,
            'status'  => 'draft',
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('procurements.index')
            ->with('success', 'Zahtev za nabavku je uspešno kreiran.');
    }

 
    public function show(Procurement $procurement)
    {
        $this->authorizeOwner($procurement);

        return view('procurements.show', compact('procurement'));
    }

  
    public function edit(Procurement $procurement)
    {
        $this->authorizeOwner($procurement);

        
        if (in_array($procurement->status, ['approved', 'rejected'])) {
            abort(403);
        }

        return view('procurements.edit', compact('procurement'));
    }

    
    public function update(Request $request, Procurement $procurement)
    {
        $this->authorizeOwner($procurement);

        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'supplier'     => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'status'       => ['nullable', 'in:draft,submitted'],
        ]);

        $procurement->update($data);

        return redirect()
            ->route('procurements.index')
            ->with('success', 'Zahtev je uspešno izmenjen.');
    }

   
    public function destroy(Procurement $procurement)
    {
        $this->authorizeOwner($procurement);

        $procurement->delete();

        return redirect()
            ->route('procurements.index')
            ->with('success', 'Zahtev je obrisan.');
    }

    private function authorizeOwner(Procurement $procurement): void
    {
        abort_unless($procurement->user_id === auth()->id(), 403);
    }
}

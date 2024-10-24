<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use Illuminate\Http\Client\Request;
use App\Http\Requests\StoreCycleRequest;
use App\Http\Requests\UpdateCycleRequest;

class CycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cycles = Cycle::with('sections.classes')->get();
        return view('cycles.index', compact('cycles'));
    }

    // Formulaire de création de cycle
    public function create()
    {
        return view('cycles.create');
    }

    // Enregistrer un cycle
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Cycle::create($request->all());

        return redirect()->route('cycles.index')->with('success', 'Cycle créé avec succès.');
    }

    // Afficher un cycle avec ses sections et classes
    public function show($id)
    {
        $cycle = Cycle::with('sections', 'classes')->findOrFail($id);
        return view('cycles.show', compact('cycle'));
    }

    // Formulaire de modification d’un cycle
    public function edit($id)
    {
        $cycle = Cycle::findOrFail($id);
        return view('cycles.edit', compact('cycle'));
    }

    // Mettre à jour un cycle
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $cycle = Cycle::findOrFail($id);
        $cycle->update($request->all());

        return redirect()->route('cycles.index')->with('success', 'Cycle mis à jour avec succès.');
    }

    // Supprimer un cycle
    public function destroy($id)
    {
        $cycle = Cycle::findOrFail($id);
        $cycle->delete();

        return redirect()->route('cycles.index')->with('success', 'Cycle supprimé avec succès.');
    }
}

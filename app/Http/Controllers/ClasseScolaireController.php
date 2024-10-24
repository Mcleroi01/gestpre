<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\ClasseScolaire;
use Illuminate\Http\Client\Request;
use App\Http\Requests\StoreClasseScolaireRequest;
use App\Http\Requests\UpdateClasseScolaireRequest;

class ClasseScolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClasseScolaire::all();
        return view('classes.index', compact('classes'));
    }

    // Affiche le formulaire de création d'une classe
    public function create()
    {
        return view('classes.create');
    }

    // Enregistre une nouvelle classe scolaire
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'niveau' => 'required',
            'section_id' => 'required|exists:sections,id',
        ]);

        ClasseScolaire::create($request->all());
        return redirect()->route('classes.index')->with('success', 'Classe ajoutée avec succès');
    }

    // Affiche le formulaire d'édition pour une classe
    public function edit($id)
    {
        $classe = ClasseScolaire::findOrFail($id);
        return view('classes.edit', compact('classe'));
    }

    // Met à jour une classe existante
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'niveau' => 'required',
            'section_id' => 'required|exists:sections,id',
        ]);

        $classe = ClasseScolaire::findOrFail($id);
        $classe->update($request->all());
        return redirect()->route('classes.index')->with('success', 'Classe mise à jour avec succès');
    }

    // Supprime une classe scolaire
    public function destroy($id)
    {
        $classe = ClasseScolaire::findOrFail($id);
        $classe->delete();
        return redirect()->route('classes.index')->with('success', 'Classe supprimée avec succès');
    }

    public function showEleves($classeId)
    {
        // Récupérer la classe et ses élèves avec les présences
        $classe = ClasseScolaire::with(['eleves.presences'])->findOrFail($classeId);

        // Les élèves sont déjà chargés dans l'objet $classe
        $eleves = $classe->eleves;

        return view('cycles.showEleves', compact('classe', 'eleves'));
    }
}

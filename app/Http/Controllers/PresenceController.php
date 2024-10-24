<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Presence;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PresenceController extends Controller
{
    /**
     * Afficher la liste des élèves d'une classe pour la gestion de présence.
     */
    public function index()
    {
        // Récupérer toutes les présences pour affichage, ou personnaliser selon tes besoins
        $presences = Presence::with('eleve')->get();

        return view('presences.index', compact('presences'));
    }

    /**
     * Enregistrer une présence d'élève.
     */
    public function store(Request $request)
    {
        $request->validate([
            'eleve_id' => 'required|exists:eleves,id',
            'date' => 'nullable|date',  // Permet de ne pas envoyer la date
            'present' => 'required|boolean',
        ]);

        // Si aucune date n'est envoyée, on utilise la date du jour
        $date = $request->input('date') ?? now()->format('Y-m-d');

        // Vérifier si la présence a déjà été enregistrée pour cet élève à cette date
        $existingPresence = Presence::where('eleve_id', $request->eleve_id)
            ->whereDate('date', $date)
            ->first();

        if ($existingPresence) {
            return redirect()->back()->with('error', 'Présence déjà enregistrée pour cet élève.');
        }

        // Enregistrer la présence
        Presence::create([
            'eleve_id' => $request->eleve_id,
            'date' => $date,
            'present' => $request->present,
        ]);

        return redirect()->back()->with('success', 'Présence enregistrée avec succès.');
    }

    /**
     * Afficher les présences d'un élève.
     */
    public function show($eleve_id)
    {
        $presences = Presence::where('eleve_id', $eleve_id)->get();
        return view('presences.show', compact('presences'));
    }

    public function scanQRCode(Request $request)
    {
        $eleve = Eleve::where('codeqr', $request->codeqr)->first();

        if ($eleve) {
            Presence::create([
                'eleve_id' => $eleve->id,
                'date' => now()->toDateString(),
                'heure' => now()->toTimeString(),
                'present' => true,
            ]);

            return response()->json(['message' => 'Présence enregistrée avec succès.']);
        } else {
            return response()->json(['message' => 'Élève non trouvé.'], 404);
        }
    }



    public function storePresence(Request $request, $eleve_id)
    {
        // Vérifier si l'élève existe
        $eleve = Eleve::findOrFail($eleve_id);

        // Obtenir la date actuelle
        $today = now()->toDateString();

        // Vérifier si la présence existe déjà pour aujourd'hui
        $presence = Presence::where('eleve_id', $eleve_id)->where('date', $today)->first();

        if ($presence) {
            return back()->with('error', 'Présence déjà enregistrée pour aujourd\'hui.');
        }

        // Enregistrer la nouvelle présence
        Presence::create([
            'eleve_id' => $eleve_id,
            'date' => $today,
            'heure' => now()->toTimeString(),
            'present' => true,
        ]);

        return redirect()->back()->with('success', 'Présence marquée avec succès.');
    }


    public function markPresence($eleve_id)
    {
        // Vérifier si l'élève existe
        $eleve = Eleve::findOrFail($eleve_id);
        return view('presences.confirmPresence', compact('eleve'));
    }
}

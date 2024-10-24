<?php

namespace App\Http\Controllers;

use TCPDF;
use App\Models\Eleve;
use App\Models\ClasseScolaire;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Http\Request; // Classe correcte pour gérer les requêtes entrantes
use Endroid\QrCode\Writer\PngWriter;


class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Liste des élèves
    public function create()
    {
        $classes = ClasseScolaire::all(); // Récupérer toutes les classes scolaires
        return view('eleves.create', compact('classes'));
    }

    // Enregistrer un nouvel élève
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'postnom' => 'nullable|string|max:255',
            'sexe' => 'required|string',
            'adresse' => 'nullable|string|max:255',
            'classe_scolaire_id' => 'required|exists:classe_scolaires,id',
        ]);

        // Création de l'élève
        Eleve::create($request->all());

        return redirect()->route('cycles.index')->with('success', 'Élève inscrit avec succès.');
    }

    public function generateClassCards($classe_id)
    {
        // Récupérer les élèves
        $eleves = Eleve::where('classe_scolaire_id', $classe_id)->get();

        if ($eleves->isEmpty()) {
            return redirect()->back()->with('error', 'Aucun élève trouvé dans cette classe.');
        }

        // Instanciation de TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Mon Application');
        $pdf->SetTitle('Cartes des Élèves');
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetAutoPageBreak(true, 10);

        // Parcours de chaque élève pour générer une carte
        foreach ($eleves as $eleve) {
            $pdf->AddPage();

            // Style de la carte
            $pdf->SetFillColor(255, 255, 255); // Fond blanc
            $pdf->Rect(10, 10, 190, 280, 'F'); // Fond de la carte

            // Ajout du logo (optionnel)
            $pdf->Image('path_to_logo.png', 15, 15, 30, 30, 'PNG');

            // Nom de l'école
            $pdf->SetFont('helvetica', 'B', 16);
            $pdf->SetTextColor(30, 136, 229); // Bleu
            $pdf->Cell(0, 10, 'Institut Supérieur Pédagogique de la Gombe', 0, 1, 'C');

            // QR Code
            $qrCode = Builder::create()
                ->writer(new PngWriter())
                ->data(route('presences.mark', ['eleve_id' => $eleve->id]))
                ->size(100)
                ->build();

            $pdf->Image('@' . $qrCode->getString(), 50, 50, 100, 100, 'PNG'); // Position du QR Code

            // Information de l'élève
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetTextColor(0, 0, 0); // Noir
            $pdf->Cell(0, 10, 'Carte d\'Élève', 0, 1, 'C');
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10,   $eleve->nom . ' ' . $eleve->prenom, 0, 1, 'C');
            $pdf->Cell(0, 10,  optional($eleve->classeScolaire)->nom, 0, 1, 'C');
            // Divider
            $pdf->SetDrawColor(30, 136, 229);
            $pdf->Line(10, 200, 200, 200); // Ligne de séparation

            // Footer de la carte
            $pdf->SetY(210);
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(0, 10, 'ID Élève: ' . $eleve->id, 0, 1, 'C');
            $pdf->Cell(0, 10, 'Année Scolaire: ' . date('Y'), 0, 1, 'C');
        }

        // Générer le PDF
        return response()->make($pdf->Output('cartes_eleves.pdf', 'D'), 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}

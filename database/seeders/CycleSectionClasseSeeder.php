<?php

namespace Database\Seeders;

use App\Models\ClasseScolaire;
use App\Models\Cycle;
use App\Models\Section;
use Illuminate\Database\Seeder;

class CycleSectionClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cycle primaire (6 classes)
        $cyclePrimaire = Cycle::create(['nom' => 'Cycle Primaire']);
        $sectionPrimaire = Section::create(['nom' => 'Section Primaire', 'cycle_id' => $cyclePrimaire->id]);

        for ($i = 1; $i <= 6; $i++) {
            ClasseScolaire::create(['nom' => 'Classe ' . $i, 'section_id' => $sectionPrimaire->id]);
        }

        // Cycle secondaire (2 classes)
        $cycleSecondaire = Cycle::create(['nom' => 'Cycle Secondaire']);
        $sectionSecondaire = Section::create(['nom' => 'Section Secondaire', 'cycle_id' => $cycleSecondaire->id]);

        for ($i = 1; $i <= 2; $i++) {
            ClasseScolaire::create(['nom' => 'Classe ' . $i, 'section_id' => $sectionSecondaire->id]);
        }

        // Cycle humanitaire (sections et classes)
        $cycleHumanitaire = Cycle::create(['nom' => 'Cycle Humanitaire']);

        // Définir les sections humanitaires
        $sectionsHumanitaires = [
            'Agriculture Générale',
            'Chimie industrielle',
            'Commercial Admin (Gestion)',
            'Commercial informatique',
            'Construction',
            'Coupe-couture',
            'Électronique',
            'Foresterie',
            'Latin-philo',
            'Maths physique',
            'Mécanique Auto',
            'Mécanique Gen',
            'Normale',
            'Nutrition',
            'Pêche et navigation',
            'Pédagogie Générale',
            'Secrétariat',
            'Secrétariat informatique',
            'Sociale',
            'Vétérinaire',
        ];

        // Créer les sections et les classes associées
        foreach ($sectionsHumanitaires as $nomSection) {
            $section = Section::create(['nom' => $nomSection, 'cycle_id' => $cycleHumanitaire->id]);

            // Créer 4 classes par section
            for ($i = 1; $i <= 4; $i++) {
                ClasseScolaire::create(['nom' => 'Classe ' . $i, 'section_id' => $section->id]);
            }
        }
    }
}

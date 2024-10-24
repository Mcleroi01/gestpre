<?php

namespace Database\Seeders;

use App\Models\Cycle;
use App\Models\Niveau;
use App\Models\Section;
use App\Models\ClasseScolaire;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        // Cycle humanitaire (4 classes)
        $cycleHumanitaire = Cycle::create(['nom' => 'Cycle Humanitaire']);
        $sectionHumanitaire = Section::create(['nom' => 'Section Humanitaire', 'cycle_id' => $cycleHumanitaire->id]);

        for ($i = 1; $i <= 4; $i++) {
            ClasseScolaire::create(['nom' => 'Classe ' . $i, 'section_id' => $sectionHumanitaire->id]);
        }
    }
}

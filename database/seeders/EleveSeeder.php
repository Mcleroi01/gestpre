<?php

namespace Database\Seeders;

use App\Models\Eleve;
use Faker\Factory as Faker;
use App\Models\ClasseScolaire;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EleveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 200; $i++) {
            DB::table('eleves')->insert([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'postnom' => $faker->lastName,
                'sexe' => $faker->randomElement(['M', 'F']),
                'adresse' => $faker->address,
                'classe_scolaire_id' => rand(1, 10), // Assurez-vous d'avoir des classes existantes
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

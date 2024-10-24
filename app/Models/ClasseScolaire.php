<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasseScolaire extends Model
{
    /** @use HasFactory<\Database\Factories\ClasseScolaireFactory> */
    use HasFactory;

    protected $table = 'classe_scolaires';

    // Définissez les champs qui peuvent être remplis via un formulaire
    protected $fillable = ['nom', 'section_id'];

    // Relation avec Section (une classe appartient à une section)
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    // Vous pouvez ajouter d'autres relations selon les besoins (par exemple, relation avec les élèves)
    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }
}

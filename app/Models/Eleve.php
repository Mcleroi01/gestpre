<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom','postnom','sexe','adresse' , 'classe_scolaire_id'];

    // Relation avec la classe
    public function classeScolaire()
    {
        return $this->belongsTo(ClasseScolaire::class);
    }

    public function tuteur()
    {
        return $this->belongsTo(Tuteur::class);
    }

    public function presences()
    {
        return $this->hasMany(Presence::class);
    }

}

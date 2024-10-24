<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = ['eleve_id', 'date', 'heure', 'present'];

    // Relation avec l'élève
    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }
}

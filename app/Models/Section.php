<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /** @use HasFactory<\Database\Factories\SectionFactory> */
    use HasFactory;

    protected $fillable = ['nom', 'cycle_id'];

    // Une section appartient à un cycle
    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }

    // Une section peut avoir plusieurs classes
    public function classes()
    {
        return $this->hasMany(ClasseScolaire::class);
    }
}

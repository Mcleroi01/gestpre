<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    /** @use HasFactory<\Database\Factories\CycleFactory> */
    use HasFactory;

    use HasFactory;

    protected $fillable = ['nom'];

    // Un cycle peut avoir plusieurs sections
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    // Un cycle peut avoir plusieurs classes (avec ou sans section)
    public function classe()
    {
        return $this->hasMany(ClasseScolaire::class);
    }
}

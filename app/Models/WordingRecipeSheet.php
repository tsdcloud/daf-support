<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordingRecipeSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_sheet_id',
        'libelle',
        'prix_unitaire',
        'quantite',
        'prix_total',
        'dossier',
        'site_prod',
    ];

    public function labels(){
        return $this->belongsTo(RecipeSheet::class);
    }
}

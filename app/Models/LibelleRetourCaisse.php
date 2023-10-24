<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibelleRetourCaisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'fiche_retour_caisse_id',
        'libelle',
        'dossier',
        'montant',
    ];
}

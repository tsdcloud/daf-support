<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachementReturnToCashSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'fiche_retour_caisse_id',
        'filename',
    ];

    public function labels(){
        return $this->belongsTo(FicheRetourCaisse::class);
    }
}

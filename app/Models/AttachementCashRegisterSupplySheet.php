<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachementCashRegisterSupplySheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'fiche_approvisionnement_caisse_id',
        'filename',
    ];
}

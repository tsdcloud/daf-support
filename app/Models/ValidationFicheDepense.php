<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidationFicheDepense extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'validateur',
        'entity_id',
    ];
}

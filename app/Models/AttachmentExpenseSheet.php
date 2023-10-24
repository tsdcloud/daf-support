<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentExpenseSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'fiche_depense_id',
        'filename',
    ];
}

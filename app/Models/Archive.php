<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    protected $fillable = [
        'demande_explication_id',
        'date_archivage',
        'sanction_id',
    ];
}

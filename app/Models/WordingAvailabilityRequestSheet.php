<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\AvailabilityRequestSheet;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WordingAvailabilityRequestSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'availability_request_sheet_id',
        'designation',
        'quantite',
        'motif',
        'beneficiaire',
        'date_debut_usage',
        'quantite_reliquat',
    ];

    public function label(){
        return $this->belongsTo(AvailabilityRequestSheet::class,'availability_request_sheet_id');
    }

    public function beneficiaires(){
        return $this->belongsTo(User::class, 'beneficiaire');
    }
}

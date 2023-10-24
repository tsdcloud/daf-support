<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AvailabilityRequestSheet;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttachementAvailabilityRequestSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'availability_request_sheet_id',
        'filename',
    ];

    public function labels(){
        return $this->belongsTo(AvailabilityRequestSheet::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigurationCompte extends Model
{
    use HasFactory;
    protected $fillable = [
        'entity_id',
        'banque',
        'intitule',
        'numero_compte',
];
public function entity(){
    return $this->belongsTo(Entity::class);
}
}

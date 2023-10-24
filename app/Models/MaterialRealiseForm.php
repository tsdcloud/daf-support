<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialRealiseForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'availability_request_sheet_id',
        'wordinavailability_request_sheet_id',
        'designation',
        'quantite_compta_mat',
        'quantite_reliquat',
        'motif',
        'beneficiaire',
        'chef_depart',
        'date_debut_usage',
        'service_demandeur',
        'numero_bon_sortie',
        'date_sortie',
        'statut',
        'comptable_matiere',
        'compteur',
        'exercice',
        'entity_id',
        'city_entity_id',
        'site_id',
    ];

    public function dmd_ids(){
        return $this->belongsTo(AvailabilityRequestSheet::class, 'availability_request_sheet_id');
    }
    public function wordin_dmd_ids(){
        return $this->belongsTo(WordingAvailabilityRequestSheet::class, 'wordinavailability_request_sheet_id');
    }

    public function demandeur_ids(){
        return $this->belongsTo(User::class,'demandeur_id');
    }
    public function comptable_matieres(){
        return $this->belongsTo(User::class,'comptable_matiere');
    }

    public function entity(){
        return $this->belongsTo(Entity::class,'entity');
    }

    public function site_id(){
        return $this->belongsTo(Site::class);
    }

    public function city_entity(){
        return $this->belongsTo(CityEntity::class);
    }
}

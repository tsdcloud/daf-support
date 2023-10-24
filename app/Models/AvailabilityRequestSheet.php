<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityRequestSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chef_depart',
        'controlleur',
        'dg',
        'president',

        'ordonateur',
        'ordonateur_rejet',

        'comptable_matier',
        'controleur_observation',
        'chef_depart_observation',
        'comptable_matier_observation',
        'user_observation',

        'produit',
        'service_demandeur',
        'statut',
        'num_dossier',
        'numero_contribuable',
        'chef_depart_rejet',
        'controleur_rejet',
        'dg_rejet',
        'president_rejet',
        'entity_id',
        'num_comptable',
        'num_compte_general',
        'code_tiers',
        'section_analytique',
        'num_cheque_virement',
        'ref_compte',
        'montant_dette',
        'retenu_source',
        'num_attestation',
        'montant_a_payer',
        'num_facture',
        'comptable',
        'city_entity_id',
        'site_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ordonateurs(){
        return $this->belongsTo(User::class, 'ordonateur');
    }

    public function chef_departs(){
        return $this->belongsTo(User::class, 'chef_depart');
    }
    public function controlleurs(){
        return $this->belongsTo(User::class, 'controlleur');
    }
    public function service_demandeurs(){
        return $this->belongsTo(Department::class, 'service_demandeur');
    }
    public function comptables(){
        return $this->belongsTo(User::class, 'comptable');
    }

    public function entity(){
        return $this->belongsTo(Entity::class);
    }

    public function city_entity(){
        return $this->belongsTo(CityEntity::class);
    }

    public function compte(){
        return $this->belongsTo(ConfigurationCompte::class, 'ref_compte');
    }

    public function attachments(){
        return $this->hasMany(AttachementAvailabilityRequestSheet::class);
    }
    public function labels(){
        return $this->hasMany(WordingAvailabilityRequestSheet::class);
    }
    public function site(){
        return $this->belongsTo(Site::class);
    }
    public function bsmf(){
        return $this->hasOne(MaterialRealiseForm::class);
    }
}

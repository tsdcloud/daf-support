<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheApprovisionnementCaisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'approvisionneur',
        'initiateur_aprovis',
        'montant',
        'provenance',
        'statut',
        'libelle',
        'ref_piece_approv',
        'compte_banc_concerne',
        'num_dossier',
        'num_comptable',

        'observation_approvisionneur',
        'observation_caisse',
        // 'Contact',
        'numero_contribuable',
        'fonction',
        'Matricule',
        'mode_approv',
        'entity_id',
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

    // relations du model de la table FAC

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function approvisionneurs (){
        return $this->belongsTo(User::class,'approvisionneur');
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
        return $this->hasMany(AttachementCashRegisterSupplySheet::class);
    }
    public function site(){
        return $this->belongsTo(Site::class);
    }


}

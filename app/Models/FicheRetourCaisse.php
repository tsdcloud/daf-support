<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheRetourCaisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'retourneur',
        'user_id',
        'numero_contribuable',
        'montant',
        'reliquat',
        'fiche_depense_id',
        'observation_retourneur',
        'observation_caisse',
        'statut',
        'num_dossier',
        'num_comptable',
        'num_dossier',
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

    public function comptables(){
        return $this->belongsTo(User::class, 'comptable');
    }

    public function retourneurs(){
        return $this->belongsTo(User::class, 'retourneur');
    }

    public function labels(){
        return $this->hasMany(LibelleRetourCaisse::class);
    }

    public function fiche_depense(){
        return $this->belongsTo(FicheDepense::class);
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
        return $this->hasMany(AttachementReturnToCashSheet::class);
    }
    public function site(){
        return $this->belongsTo(Site::class);
    }
}

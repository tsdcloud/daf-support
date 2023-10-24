<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheDepense extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_etablissement',
        'user_id',
        'beneficiaire',
        'controlleur',
        'controlleur_conf',
        'ordonateur',
        'destinataire',
        'statut',
        'montant',
        'description',
        'mode_paiment',
        'numero_contribuable',
        'ordonateur_rejet',
        'controleur_rejet',
        'controleur_conf_rejet',
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
    public function beneficiaires(){
        return $this->belongsTo(User::class, 'beneficiaire');
    }
    public function ordonateurs(){
        return $this->belongsTo(User::class, 'ordonateur');
    }
    public function controlleurs(){
        return $this->belongsTo(User::class, 'controlleur');
    }
    // public function controlleur_confs(){
    //     return $this->belongsTo(User::class, 'controlleur_conf');
    // }
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
        return $this->hasMany(AttachmentExpenseSheet::class);
    }
    public function site(){
        return $this->belongsTo(Site::class);
    }
}

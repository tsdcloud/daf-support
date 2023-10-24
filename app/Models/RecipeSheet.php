<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeSheet extends Model
{
    use HasFactory;
    protected $table = "recipe_sheets";
    protected $fillable = [
        'id',
        'user_id',
        'apporteur',
        'raison_sociale',
        'numero_contribuable',
        'contact',
        'montant',
        'provenance',
        'mode_paiment',
        'statut',

        'controlleur',
        'caisse',
        'observation_controlleurer',
        'observation_apporteur',
        'observation_caisse',

        'shift',
        'observation_support_partenaire',
        'num_rappot_de_shift',
        'support_partenaire',

        'num_comptable',
        'num_dossier',
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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comptables(){
        return $this->belongsTo(User::class, 'comptable');
    }

    public function controlleurs(){
        return $this->belongsTo(User::class, 'controlleur');
    }

    public function apporteurs(){
        return $this->belongsTo(User::class, 'apporteur');
    }

    public function support_partenaires(){
        return $this->belongsTo(User::class, 'support_partenaire');
    }

    public function labels(){
        return $this->hasMany(WordingRecipeSheet::class);
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
        return $this->hasMany(AttachementRecipeSheet::class);
    }
    public function site(){
        return $this->belongsTo(Site::class);
    }
}

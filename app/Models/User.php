<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use function PHPUnit\Framework\returnSelf;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'email',
        'password',
        'matricule'
    ];

    public $isAdmin = false;
    public $isComptable = false;
    public $isOrdonnateur = false;
    public $isControleur = false;
    public $isControleur_conf = false;
    public $isCaissier = false;
    public $isChef_depart = false;
    public $isControler_recipe = false;
    public $isCoordonnateur = false;
    public $isChef_guerite = false;
    public $isComptable_matiere = false;
    public $isD_g = false;
    public $isPrésident = false;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function current_entity(){
        return Fonction::find(session('fonction_id')['fonction_id'])->user_entity;
    }

    public function current_user_entity(){

        return Fonction::find(session('fonction_id')['fonction_id'])->user_entity;

    }

    public function user_entity(){
        return $this->hasMany(UserEntity::class);
    }

    public function privileges(){
        return $this->hasMany(Privilege::class);
    }

    public function isAdmin(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Administrateur'){
                $this->isAdmin = true;
            }
        }
        return $this->isAdmin;
    }

    public function isComptable(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Comptable'){
                $this->isComptable = true;
            }
        }
        return $this->isComptable;
    }

    public function isOrdonnateur(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Ordonnateur'){
                $this->isOrdonnateur = true;
            }
        }
        return $this->isOrdonnateur;
    }

    public function isControleur(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Contrôleur budgétaire'){
                $this->isControleur = true;
            }
        }
        return $this->isControleur;
    }

    public function isControleur_conf(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Contrôleur conformité'){
                $this->isControleur_conf = true;
            }
        }
        return $this->isControleur_conf;
    }

    public function isCaissier(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Caissier'){
                $this->isCaissier = true;
            }
        }
        return $this->isCaissier;
    }


    public function isChef_depart(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Chef département'){
                $this->isChef_depart = true;
            }
        }
        return $this->isChef_depart;
    }


    public function isControler_recipe(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Contrôleur recette'){
                $this->isControler_recipe = true;
            }
        }
        return $this->isControler_recipe;
    }


    public function isCoordonnateur(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Coordonnateur'){
                $this->isCoordonnateur = true;
            }
        }
        return $this->isCoordonnateur;
    }


    public function isChef_guerite(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Chef de guérite '){
                $this->isChef_guerite = true;
            }
        }
        return $this->isChef_guerite;
    }

    public function isComptable_matiere(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Comptable matière'){
                $this->isComptable_matiere = true;
            }
        }
        return $this->isComptable_matiere;
    }


    public function isD_g(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Directeur général'){
                $this->isD_g = true;
            }
        }
        return $this->isD_g;
    }

    public function isPrésident(){
        foreach($this->privileges as $privilege){
            if($privilege->role->title == 'Président'){
                $this->isPrésident = true;
            }
        }
        return $this->isPrésident;
    }


    // public function recipe_sheets(){
    //     return $this->hasMany(RecipeSheet::class);
    // }

}

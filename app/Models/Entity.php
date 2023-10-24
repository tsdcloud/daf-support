<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'sigle',
        'logo',
    ];

    protected $with = [
        'city_entities',
        'cities'
    ];

    public function ficheDepenses(){
            return $this->hasMany(FicheDepense::class);
    }

    public function cities(){
        return $this->belongsToMany(City::class)->withPivot('id');
        // return $this->belongsToMany(City::class)->using(CityEntity::class);
    }

    public function city_entities(){
        return $this->hasMany(CityEntity::class);
    }

    public function sites(){

        return $this->hasMany(Site::class);
    }

    public function recipe_sheets(){
        return $this->hasMany(RecipeSheet::class);
    }
}

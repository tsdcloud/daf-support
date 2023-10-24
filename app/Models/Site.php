<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    protected $table = 'sites';
    protected $fillable = [
        'label',
        'city_id',
        'entity_id',
        'localisation',
        'user_id',

    ];

    // protected $with=['city'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function recipe_sheets(){
        return $this->hasMany(RecipeSheet::class);
    }

    public function entity(){
        return $this->belongsTo(Entity::class);
    }

    public function city_entity(){
        return $this->belongsTo(CityEntity::class);
    }
}

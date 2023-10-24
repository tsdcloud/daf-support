<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produce extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'label',
        'prix_unitaire',
        'contionnement',
        'description',
        // 'title',
];

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CityEntity extends Pivot
{
    use HasFactory;

    // protected $fillable = [
    //     'entity_id',
    //     'city_id',
    // ];

    protected $guarded = [];

    protected $table = 'city_entity';
    // protected $table = 'city_entities';

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function recipe_sheets(){
        return $this->hasMany(RecipeSheet::class);
    }
}

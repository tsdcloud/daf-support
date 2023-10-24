<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'country_id',
        'id',
    ];

    protected $with = ['sites', 'country'];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function sites(){
        return $this->hasMany(Site::class);
    }

    // public function site_recipe_sheets(){

    //     return $this->hasMany(SiteRecipeSheet::class);
    // }

    public function entities(){
        return $this->belongsToMany(Entity::class)->withPivot('id');
    }

}

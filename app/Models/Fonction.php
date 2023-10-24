<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;
    protected $fillable =[
        'fonction',
        'user_entity_id',
        'category_id',
        'echelon_id',
        'department_id',
    ];


    public function user_entity(){
        return $this->belongsTo(UserEntity::class);
    }
}

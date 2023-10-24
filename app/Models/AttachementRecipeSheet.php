<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachementRecipeSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_sheet_id',
        'filename',
    ];

    public function labels(){
        return $this->belongsTo(RecipeSheet::class);
    }
}

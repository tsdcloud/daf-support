<?php

namespace App\Models;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use App\Models\AvailabilityRequestSheet;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class FamilyArticle extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'label',
        'description',
        'creator',
    ];

    protected $with = ['articles'];

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function availability_request_sheets(){
        return $this->hasMany(AvailabilityRequestSheet::class);
    }
}

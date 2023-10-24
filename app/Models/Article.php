<?php

namespace App\Models;

use App\Models\User;
use App\Models\FamilyArticle;
use Illuminate\Database\Eloquent\Model;
use App\Models\AvailabilityRequestSheet;
use App\Models\WordingAvailabilityRequestSheet;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'label',
        'family_article_id',
        'description',
        'creator',
    ];

    // protected $with = ['family_article'];

    public function family_article(){
        return $this->belongsTo(FamilyArticle::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function availability_request_sheets(){
        return $this->hasMany(AvailabilityRequestSheet::class);
    }

    public function wording_availability_request_sheets(){
        return $this->hasMany(WordingAvailabilityRequestSheet::class);
    }
}

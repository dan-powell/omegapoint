<?php

namespace App\Models\Area;

use App\Enum\Area\Tier;
use App\Models\News\Article;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'area_district';

    protected $fillable = [
        'name',
        'tier'
    ];

    protected function tierName(): Attribute
    {
        return Attribute::make(
            get: fn () => Tier::from($this->tier)->name(), 
        );
    }

    public function pointOfInterests()
    {
        return $this->belongsToMany(PointOfInterest::class, 'area_district_poi', 'district_id', 'poi_id');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'news_article_district', 'district_id', 'article_id');
    }
}

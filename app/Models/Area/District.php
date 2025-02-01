<?php

namespace App\Models\Area;

use App\Enum\Area\Tier;
use App\Models\News\Article;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    use HasFactory;

    protected $table = 'area_district';

    protected $fillable = [
        'name',
        'tier'
    ];

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn (): string => route('news.index', ['dis[0]' => $this->id]) . '#article-list', 
        );
    }

    protected function tierName(): Attribute
    {
        return Attribute::make(
            get: fn () => Tier::from($this->tier)->name(), 
        );
    }

    protected function articleCount(): Attribute
    {
        $this->loadMissing('articles');
        return Attribute::make(
            get: fn (): int => count($this->articles), 
        );
    }

    public function pointsOfInterest()
    {
        return $this->belongsToMany(PointOfInterest::class, 'area_district_poi', 'district_id', 'poi_id');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'news_article_district', 'district_id', 'article_id');
    }
}

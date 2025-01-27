<?php

namespace App\Models\News;

use App\Models\Area\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{

    use HasFactory;
    use HasUlids;
    
    protected $table = 'news_article';

    protected $fillable = [
        'title',
        'slug',
        'short',
        'summary',
        'thumbnail',
        'lead',
        'introduction',
        'tldr',
        'meta_title',
        'meta_description',
        'body',
        'updates',
        'date',
        'published_date'
    ];

    protected function casts(): array
    {
        return [
            'body' => 'json',
            'updates' => 'json',
            'date' => 'datetime',
            'published_date' => 'datetime'
        ];
    }

    // protected function tierName(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => 'hello', 
    //     );
    // }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'news_article_subject', 'article_id', 'subject_id');
    }

    public function districts()
    {
        return $this->belongsToMany(District::class, 'news_article_district', 'article_id', 'district_id');
    }
}

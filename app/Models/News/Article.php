<?php

namespace App\Models\News;

use App\Models\Area\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn ():string => route('news.article.show', $this), 
        );
    }

    public function bodyFormatted(): Attribute
    {
        return Attribute::make(
            get: function ():string {
                return $this->body;
            }
        );
    }


    public static function latest(): ?Article
    {
        return Article::orderBy('date')->limit(1)->first();
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'news_article_subject', 'article_id', 'subject_id');
    }

    public function districts(): BelongsToMany
    {
        return $this->belongsToMany(District::class, 'news_article_district', 'article_id', 'district_id');
    }
}

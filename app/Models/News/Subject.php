<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{

    use HasFactory;

    protected $table = 'news_subject';

    protected $fillable = [
        'name',
    ];

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn (): string => route('news.index', ['sub[0]' => $this->id]) . '#article-list', 
        );
    }

    protected function articleCount(): Attribute
    {
        $this->loadMissing('articles');
        return Attribute::make(
            get: fn (): int => count($this->articles), 
        );
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'news_article_subject', 'subject_id', 'article_id');
    }
}

<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Subject extends Model
{
    protected $table = 'news_subject';

    protected $fillable = [
        'name',
    ];

    // protected function tierName(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => 'hello', 
    //     );
    // }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'news_article_subject', 'subject_id', 'article_id');
    }
}

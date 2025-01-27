<?php

namespace Database\Seeders;

use App\Models\News\Article;
use App\Models\News\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Subject::factory()
            ->count(10)
            ->create();

        $articles = Article::factory()
            ->count(20)
            ->create();

        foreach($articles as $article) {
            $article->subjects()->attach(
                Subject::inRandomOrder()->limit(rand(1,3))->get()
            );
        }
    }
}

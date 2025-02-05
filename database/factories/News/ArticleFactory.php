<?php

namespace Database\Factories\News;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'short' => fake()->name(),
            'summary' => fake()->sentence(),
            'thumbnail'=> 'test/test1.webp',
            'lead' => ['test/test1.webp', 'test/test1.webp', 'test/test1.webp'],
            'introduction' => fake()->paragraphs(rand(1,3), true),
            'tldr' => fake()->paragraphs(rand(2,3), true),
            'meta_title' => fake()->sentence(),
            'meta_description' => fake()->sentence(),
            'sections' => null,
            'updates' => null,
            'date' => fake()->dateTime(),
            'published_date' => rand(0,1) ? fake()->dateTime() : null,
        ];
    }
}

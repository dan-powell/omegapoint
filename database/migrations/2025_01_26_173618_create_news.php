<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news_article', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->string('short')->nullable();
            $table->string('summary')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('lead')->nullable();
            $table->text('introduction')->nullable();
            $table->text('tldr')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->json('sections')->nullable();
            $table->json('updates')->nullable();
            $table->datetime('date');
            $table->datetime('published_date')->nullable();
            $table->timestamps();
        });

        Schema::create('news_subject', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('news_article_subject', function (Blueprint $table) {
            $table->foreignUlid('article_id')->references('id')->on('news_article')->onDelete('cascade');
            $table->foreignId('subject_id')->references('id')->on('news_subject')->onDelete('cascade');
            $table->unique(['article_id', 'subject_id']);
        });

        Schema::create('news_article_district', function (Blueprint $table) {
            $table->foreignUlid('article_id')->references('id')->on('news_article')->onDelete('cascade');
            $table->foreignId('district_id')->references('id')->on('area_district')->onDelete('cascade');
            $table->unique(['article_id', 'district_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_article_district');
        Schema::dropIfExists('news_article_subject');
        Schema::dropIfExists('news_subject');
        Schema::dropIfExists('news_article');
    }
};

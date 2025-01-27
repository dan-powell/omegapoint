<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;


// News
Route::domain('news.' . config('app.domain'))->name('news.')->controller(NewsController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('articles/{id}', 'articleShow')->name('article.show');
});

// Home
Route::domain(config('app.domain'))->name('home.')->group(function() {
    Route::view('/', 'home.index')->name('index');
});
<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;


// New
Route::domain('news.' . config('app.domain'))->name('news.')->controller(NewsController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('articles/{id}', 'articleShow')->name('article.show');
});

// Home
Route::domain(config('app.domain'))->name('home.')->group(function() {
    Route::view('/', 'home.index')->name('index');
});

// Media
Route::domain('media.' . config('app.domain'))->name('media.')->group(function() {
    Route::get(config('glide.route') . '/{path}', [MediaController::class, 'handle'])->where('path', '.*');
});




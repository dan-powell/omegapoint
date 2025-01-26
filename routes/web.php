<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;



Route::domain('news.' . config('app.domain'))->name('news.')->controller(NewsController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('articles/{id}', 'show')->name('show');
});

Route::domain(config('app.domain'))->name('home.')->group(function() {
    Route::view('/', 'home.index')->name('index');
});
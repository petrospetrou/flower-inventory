<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FlowerController;
use App\Http\Controllers\CategoryController;

Route::get('/', fn () => redirect()->route('flowers.index'))->name('home');

Route::resource('flowers', FlowerController::class);
Route::resource('categories', CategoryController::class)->except(['show']);


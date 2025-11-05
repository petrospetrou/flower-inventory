<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FlowerController;
use App\Http\Controllers\CategoryController;

Route::get('/', fn () => redirect()->route('flowers.index'))->name('home');

Route::resource('flowers', FlowerController::class);
Route::resource('categories', CategoryController::class)->except(['show']);

Route::get('flowers/{flower}/delete', [\App\Http\Controllers\FlowerController::class, 'confirmDestroy'])
    ->name('flowers.confirm-delete');
Route::get('categories/{category}/delete', [\App\Http\Controllers\CategoryController::class, 'confirmDestroy'])
->name('categories.confirm-delete');

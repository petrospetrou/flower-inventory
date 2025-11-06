<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FlowerController;
use App\Http\Controllers\CategoryController;

// Redirect the home route to the flowers index page
Route::get('/', fn () => redirect()->route('flowers.index'))->name('home');

// Resource routes for managing flowers (CRUD)
Route::resource('flowers', FlowerController::class);

// Resource routes for managing categories (CRUD, excluding 'show')
Route::resource('categories', CategoryController::class)->except(['show']);

// Route to confirm flower deletion before permanently removing it
Route::get('flowers/{flower}/delete', [\App\Http\Controllers\FlowerController::class, 'confirmDestroy'])
    ->name('flowers.confirm-delete');

// Route to confirm category deletion before permanently removing it
Route::get('categories/{category}/delete', [\App\Http\Controllers\CategoryController::class, 'confirmDestroy'])
    ->name('categories.confirm-delete');

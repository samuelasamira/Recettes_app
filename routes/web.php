<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [ProfileController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('recipes', RecipeController::class)->except(['index', 'show']);
    
    Route::post('recipes/{recipe}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    Route::post('recipes/{recipe}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('recipes/{recipe}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    
    Route::post('recipes/{recipe}/rating', [RatingController::class, 'store'])->name('ratings.store');
    Route::delete('ratings/{rating}', [RatingController::class, 'destroy'])->name('ratings.destroy');
});

// Pages statiques
Route::get('/a-propos', [PageController::class, 'about'])->name('pages.about');
Route::get('/confidentialite', [PageController::class, 'privacy'])->name('pages.privacy');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::get('/conditions', [PageController::class, 'terms'])->name('pages.terms');

// Public routes for viewing recipes
Route::get('recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

require __DIR__.'/auth.php';
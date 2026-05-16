<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes protégées par authentification
Route::middleware('auth')->group(function () {

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Recettes (create, store, edit, update, destroy)
    Route::resource('recipes', RecipeController::class)->except(['index', 'show']);

    // Commentaires
    Route::post('recipes/{recipe}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Favoris
    Route::post('recipes/{recipe}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('recipes/{recipe}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // Notes
    Route::post('recipes/{recipe}/rating', [RatingController::class, 'store'])->name('ratings.store');
    Route::delete('ratings/{rating}', [RatingController::class, 'destroy'])->name('ratings.destroy');

});

// Routes publiques (visibles sans connexion)
Route::get('recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

require __DIR__.'/auth.php';
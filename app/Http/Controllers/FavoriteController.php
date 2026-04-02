<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Add recipe to favorites
     */
    public function store(Request $request, Recipe $recipe)
    {
        $existingFavorite = Favorite::where('user_id', Auth::id())
                                    ->where('recipe_id', $recipe->id)
                                    ->first();

        if ($existingFavorite) {
            return back()->with('info', 'Cette recette est déjà en favori!');
        }

        Favorite::create([
            'user_id' => Auth::id(),
            'recipe_id' => $recipe->id,
        ]);

        return back()->with('success', 'Recette ajoutée aux favoris!');
    }

    /**
     * Remove recipe from favorites
     */
    public function destroy(Request $request, Recipe $recipe)
    {
        Favorite::where('user_id', Auth::id())
                ->where('recipe_id', $recipe->id)
                ->delete();

        return back()->with('success', 'Recette supprimée des favoris!');
    }
}

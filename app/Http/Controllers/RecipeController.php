<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    /**
     * Display a listing of recipes
     */
    public function index()
    {
        $recipes = Recipe::with('user', 'ingredients', 'ratings')
                        ->latest()
                        ->paginate(12);
        
        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new recipe
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('recipes.create', compact('ingredients'));
    }

    /**
     * Store a newly created recipe
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'required|integer|min:1',
            'cook_time' => 'required|integer|min:1',
            'servings' => 'required|integer|min:1',
            'cuisine_type' => 'required|string',
            'difficulty' => 'required|in:facile,moyen,difficile',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*.id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('recipes', 'public');
        }

        $validated['user_id'] = Auth::id();

        $recipe = Recipe::create($validated);

        // Attach ingredients
        foreach ($request->ingredients as $ingredient) {
            $recipe->ingredients()->attach($ingredient['id'], [
                'quantity' => $ingredient['quantity']
            ]);
        }

        return redirect()->route('recipes.show', $recipe)
                        ->with('success', 'Recette créée avec succès!');
    }

    /**
     * Display the specified recipe
     */
    public function show(Recipe $recipe)
    {
        $recipe->load('user', 'ingredients', 'comments.user', 'ratings.user', 'favorites');
        
        $averageRating = $recipe->averageRating();
        $userHasFavorited = Auth::check() && $recipe->isFavoritedBy(Auth::user());
        $userRating = Auth::check() ? $recipe->ratings()
                                            ->where('user_id', Auth::id())
                                            ->first() : null;

        return view('recipes.show', compact('recipe', 'averageRating', 'userHasFavorited', 'userRating'));
    }

    /**
     * Show the form for editing the recipe
     */
    public function edit(Recipe $recipe)
    {
        $this->authorize('update', $recipe);
        
        $ingredients = Ingredient::all();
        $recipe->load('ingredients');

        return view('recipes.edit', compact('recipe', 'ingredients'));
    }

    /**
     * Update the specified recipe
     */
    public function update(Request $request, Recipe $recipe)
    {
        $this->authorize('update', $recipe);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'required|integer|min:1',
            'cook_time' => 'required|integer|min:1',
            'servings' => 'required|integer|min:1',
            'cuisine_type' => 'required|string',
            'difficulty' => 'required|in:facile,moyen,difficile',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*.id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($recipe->image_path) {
                Storage::disk('public')->delete($recipe->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update($validated);

        // Update ingredients
        $recipe->ingredients()->detach();
        foreach ($request->ingredients as $ingredient) {
            $recipe->ingredients()->attach($ingredient['id'], [
                'quantity' => $ingredient['quantity']
            ]);
        }

        return redirect()->route('recipes.show', $recipe)
                        ->with('success', 'Recette mise à jour avec succès!');
    }

    /**
     * Delete the specified recipe
     */
    public function destroy(Recipe $recipe)
    {
        $this->authorize('delete', $recipe);

        if ($recipe->image_path) {
            Storage::disk('public')->delete($recipe->image_path);
        }

        $recipe->delete();

        return redirect()->route('recipes.index')
                        ->with('success', 'Recette supprimée avec succès!');
    }
}
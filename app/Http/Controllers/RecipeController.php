<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::with(['user', 'ratings']);

        if ($request->search)
            $query->where('title', 'like', '%' . $request->search . '%');

        if ($request->difficulty)
            $query->where('difficulty', $request->difficulty);

        if ($request->cuisine)
            $query->where('cuisine_type', $request->cuisine);

        $recipes = $query->latest()->paginate(12);

        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        $ingredients = Ingredient::orderBy('name')->get();
        return view('recipes.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                  => 'required|string|max:255',
            'description'            => 'required|string',
            'instructions'           => 'required|string',
            'prep_time'              => 'required|integer|min:1',
            'cook_time'              => 'required|integer|min:1',
            'servings'               => 'required|integer|min:1',
            'cuisine_type'           => 'required|string',
            'difficulty'             => 'required|in:facile,moyen,difficile',
            'image'                  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredients'            => 'required|array',
            'ingredients.*.id'       => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|string',
        ]);

        if ($request->hasFile('image'))
            $validated['image_path'] = $request->file('image')->store('recipes', 'public');

        $validated['user_id'] = Auth::id();
        $recipe = Recipe::create($validated);

        foreach ($request->ingredients as $ing)
            $recipe->ingredients()->attach($ing['id'], ['quantity' => $ing['quantity']]);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recette créée avec succès !');
    }

    public function show(Recipe $recipe)
    {
        $recipe->load('user', 'ingredients', 'comments.user', 'ratings.user', 'favorites');
        $averageRating    = $recipe->averageRating();
        $userHasFavorited = Auth::check() && $recipe->isFavoritedBy(Auth::user());
        $userRating       = Auth::check() ? $recipe->ratings()->where('user_id', Auth::id())->first() : null;
        return view('recipes.show', compact('recipe', 'averageRating', 'userHasFavorited', 'userRating'));
    }

    public function edit(Recipe $recipe)
    {
        // Vérification manuelle des droits
        if (auth()->user()->id !== $recipe->user_id) {
            abort(403, 'Action non autorisée.');
        }

        $ingredients = Ingredient::orderBy('name')->get();
        $recipe->load('ingredients');
        return view('recipes.edit', compact('recipe', 'ingredients'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        // Vérification manuelle des droits
        if (auth()->user()->id !== $recipe->user_id) {
            abort(403, 'Action non autorisée.');
        }

        $validated = $request->validate([
            'title'                  => 'required|string|max:255',
            'description'            => 'required|string',
            'instructions'           => 'required|string',
            'prep_time'              => 'required|integer|min:1',
            'cook_time'              => 'required|integer|min:1',
            'servings'               => 'required|integer|min:1',
            'cuisine_type'           => 'required|string',
            'difficulty'             => 'required|in:facile,moyen,difficile',
            'image'                  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredients'            => 'required|array',
            'ingredients.*.id'       => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            if ($recipe->image_path && !str_starts_with($recipe->image_path, 'http'))
                Storage::disk('public')->delete($recipe->image_path);
            $validated['image_path'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update($validated);
        $recipe->ingredients()->detach();

        foreach ($request->ingredients as $ing)
            $recipe->ingredients()->attach($ing['id'], ['quantity' => $ing['quantity']]);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recette mise à jour !');
    }

    public function destroy(Recipe $recipe)
    {
        // Vérification manuelle des droits
        if (auth()->user()->id !== $recipe->user_id) {
            abort(403, 'Action non autorisée.');
        }

        if ($recipe->image_path && !str_starts_with($recipe->image_path, 'http'))
            Storage::disk('public')->delete($recipe->image_path);

        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recette supprimée !');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Store or update a rating
     */
    public function store(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $validated['recipe_id'] = $recipe->id;
        $validated['user_id'] = Auth::id();

        // Update if exists, create if not
        Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'recipe_id' => $recipe->id,
            ],
            $validated
        );

        return back()->with('success', 'Note enregistrée avec succès!');
    }

    /**
     * Delete the specified rating
     */
    public function destroy(Rating $rating)
    {
        $this->authorize('delete', $rating);
        
        $rating->delete();

        return back()->with('success', 'Note supprimée avec succès!');
    }
}
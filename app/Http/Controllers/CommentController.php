<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment
     */
    public function store(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:3|max:1000',
        ]);

        $validated['recipe_id'] = $recipe->id;
        $validated['user_id'] = Auth::id();

        Comment::create($validated);

        return back()->with('success', 'Commentaire ajouté avec succès!');
    }

    /**
     * Delete the specified comment
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        
        $recipe = $comment->recipe;
        $comment->delete();

        return back()->with('success', 'Commentaire supprimé avec succès!');
    }
}

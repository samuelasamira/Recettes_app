<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Display the user's dashboard.
     */
    public function dashboard(): View
    {
        $user = Auth::user();
        
        // Mes recettes (les 4 plus récentes)
        $userRecipes = $user->recipes()->latest()->take(4)->get();
        $userRecipesCount = $user->recipes()->count();
        
        // Mes favoris
        $favoriteRecipes = $user->favorites()->with('recipe.user')->get()->pluck('recipe');
        
        // Mes notes récentes
        $recentRatings = $user->ratings()->with('recipe')->latest()->take(5)->get();
        
        // Note moyenne de l'utilisateur
        $averageRating = $user->ratings()->avg('rating') ?? 0;
        
        // Vues totales des recettes de l'utilisateur
        $totalViews = $user->recipes()->sum('views') ?? 0;
        
        return view('dashboard', compact(
            'userRecipes',
            'userRecipesCount',
            'favoriteRecipes',
            'recentRatings',
            'averageRating',
            'totalViews'
        ));
    }
}
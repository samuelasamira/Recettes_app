<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;

class RecipePolicy
{
    /**
     * Determine if the user can view any recipes
     */
    public function viewAny(?User $user): bool
    {
        return true; // Tout le monde peut voir les recettes
    }

    /**
     * Determine if the user can view the recipe
     */
    public function view(?User $user, Recipe $recipe): bool
    {
        return true; // Tout le monde peut voir une recette
    }

    /**
     * Determine if the user can create recipes
     */
    public function create(User $user): bool
    {
        return true; // Les utilisateurs connectés peuvent créer
    }

    /**
     * Determine if the user can update the recipe
     */
    public function update(User $user, Recipe $recipe): bool
    {
        return $user->id === $recipe->user_id; // Seulement le propriétaire peut modifier
    }

    /**
     * Determine if the user can delete the recipe
     */
    public function delete(User $user, Recipe $recipe): bool
    {
        return $user->id === $recipe->user_id; // Seulement le propriétaire peut supprimer
    }
}

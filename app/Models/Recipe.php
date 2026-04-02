<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'instructions',
        'prep_time',
        'cook_time',
        'servings',
        'cuisine_type',
        'difficulty',
        'image_path',
    ];

    // Relation : Une recette appartient à un utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation : Une recette a plusieurs ingrédients
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredient')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    // Relation : Une recette a plusieurs commentaires
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Relation : Une recette a plusieurs favoris
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    // Relation : Une recette a plusieurs notations
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    // Helper : Vérifier si un user a aimé cette recette
    public function isFavoritedBy(User $user): bool
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    // Helper : Obtenir la note moyenne
    public function averageRating(): float
    {
        return $this->ratings()->avg('rating') ?? 0;
    }
}

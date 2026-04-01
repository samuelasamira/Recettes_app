<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    /**
     * L'utilisateur qui a créé cette recette
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Les ingrédients de cette recette
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredient')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    /**
     * Les commentaires sur cette recette
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Les favoris de cette recette
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Les évaluations de cette recette
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Moyenne des notes
     */
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}
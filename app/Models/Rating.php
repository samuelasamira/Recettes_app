<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    protected $fillable = ['recipe_id', 'user_id', 'rating', 'review'];

    // Relation : Une note appartient à une recette
    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    // Relation : Une note appartient à un utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
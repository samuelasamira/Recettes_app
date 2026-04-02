<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['recipe_id', 'user_id', 'content'];

    // Relation : Un commentaire appartient à une recette
    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    // Relation : Un commentaire appartient à un utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

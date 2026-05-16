<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        "user_id","title","description","instructions",
        "prep_time","cook_time","servings",
        "cuisine_type","difficulty","image_path"
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function ingredients() { return $this->belongsToMany(Ingredient::class,"recipe_ingredient")->withPivot("quantity")->withTimestamps(); }
    public function comments() { return $this->hasMany(Comment::class); }
    public function favorites() { return $this->hasMany(Favorite::class); }
    public function ratings() { return $this->hasMany(Rating::class); }
    public function isFavoritedBy(User $user): bool { return $this->favorites()->where("user_id",$user->id)->exists(); }
    public function averageRating(): float { return $this->ratings()->avg("rating") ?? 0; }
}
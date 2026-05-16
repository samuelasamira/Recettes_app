<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // Relations
    public function recipes()  { return $this->hasMany(Recipe::class); }
    public function comments() { return $this->hasMany(Comment::class); }
    public function favorites(){ return $this->hasMany(Favorite::class); }
    public function ratings()  { return $this->hasMany(Rating::class); }
}
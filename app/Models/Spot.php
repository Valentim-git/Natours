<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $fillable = ['name', 'cost', 'path', 'city', 'description'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function slots()
    {
        return $this->hasMany(Slot::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'spot_id', 'user_id')->withTimestamps();
    }

    public function addToFavorites(User $user)
    {
        $this->favoritedBy()->attach($user->id);
    }

    public function removeFromFavorites(User $user)
    {
        $this->favoritedBy()->detach($user->id);
    }


    public function isFavoritedBy(User $user)
    {
        return $this->favoritedBy->contains($user);
    }

    // Escopo para consultar spots favoritos de um usuário
    public function scopeFavorited($query, User $user)
    {
        return $query->whereHas('favoritedBy', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function averageRating()
    {
        $totalRatings = $this->comments->count();

        if ($totalRatings === 0) {
            return 0; // Retorna 0 se não houver nenhum rating.
        }

        $sumRatings = $this->comments->sum('rating');

        return $sumRatings / $totalRatings;
    }
}

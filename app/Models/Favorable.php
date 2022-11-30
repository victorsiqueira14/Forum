<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


trait Favorable
{
    use HasFactory;
    protected $with = ['owner', 'favorites'];

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }


    public function favorite($userId)
    {
        $atributes = ['user_id' => $userId];

        if (!  $this->favorites()->where($atributes)->exists()) {
           return $this->favorites()->create($atributes);
        }

    }


    public function isFavorited()
    {
        return !! $this->favorites->where('user_id', auth()->id())->count();

    }

    public function getFavoritesCountAttribute()
    {
        return $this->isFavorited();
    }


}

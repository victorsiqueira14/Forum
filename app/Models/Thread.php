<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
    ];

    public function path()
    {
        return $this->id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}


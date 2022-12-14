<?php

namespace App\Models;

use App\Models\User;
use App\Models\Thread;
use App\Models\Favorable;
use App\Models\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;
    use Favorable, RecordsActivity;

    protected $fillable = [
        'user_id',
        'thread_id',
        'body',
    ];

    protected $guarded = [];

    protected $with = ['owner', 'favorites'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}


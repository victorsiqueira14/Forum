<?php

namespace App\Models;


use App\Models\Channel;
use App\Models\Activity;
use App\Models\RecordsActivity;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Thread extends Model
{
    use HasFactory;
    use RecordsActivity;

    protected $fillable = [
        'user_id',
        'channel_id',
        'title',
        'body',
    ];

    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();

        Paginator::useBootstrap();

        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });

        static::deleting(function ($thread){
            $thread->replies->each->delete();
        });
    }

    public function path()
    {
        return "{$this->channel->slug}/{$this->id}";
    }

    public function pathView()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);

    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}

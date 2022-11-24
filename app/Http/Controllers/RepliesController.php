<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

    public function __contruct()
    {
        $this->middleware('auth');
    }
/**
 * Undocumented function
 *
 * @param Channel $channelIds
 * @param Thread $thread
 * @return void
 */
    public function store($channelIds, Thread $thread)
    {
        $this->validate(request(), [
            'body' =>'required'

        ]);

        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);
        return back();
    }
    
}

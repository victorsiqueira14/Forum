<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     *
     * @param Reply $reply
     * @return void
     */
    public function store(Reply $reply)
    {
        $reply->favorite(auth()->id());

        return back();
    }
}

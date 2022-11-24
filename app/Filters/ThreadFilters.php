<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;


class ThreadFilters extends Filters
{
    protected $filters = [
        'by'
    ];

    /**
     * filter the query by a given username
     * @param string $username
     * @return mixed
     */

    public function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        
        return $this->builder->where('user_id', $user->id);
    }

}

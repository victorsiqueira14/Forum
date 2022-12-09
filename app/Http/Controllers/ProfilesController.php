<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;

/**
 * @param User $$user
 * @return \Response
 */
class ProfilesController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @param  User $user
     * @return \Response
     */
    public function show(User $user)
    {
        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => Activity::feed($user)
        ]);
    }
}



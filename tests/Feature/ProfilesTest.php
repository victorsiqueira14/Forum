<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ProfilesTest
{
    use DatabaseMigrations;

    public function test_a_user_has_a_profile()
    {
        $user = User::factory()->create();

        $this->get("/profile/{$user->name}")
            ->assertSee($user->name);
    }

    public function test_profiles_display_all_threads_created_by_the_associated_user()
    {
        $user = User::factory()->create();
        $thread = Thread::factory()->create([ 'user_id' => $user->id]);

        $this->get("/profile/{$user->name}")
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

}

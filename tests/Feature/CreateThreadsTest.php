<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    // public function test_guests_may_not_create_a_threads()
    // {
    //     //
    // }

    public function test_an_authenticated_user_can_create_new_forum_threads()

    {

        $this->withoutExceptionHandling();

        // Given we have a user
        $user = User::factory()->create();

        // And that user is authenticated
        $this->actingAs($user);

        // And we have a thread created by that user
        $thread = Thread::factory()->create([
            'user_id' => $user->id
        ]);

        // And once we hit the endpoint to create a new thread
        $this->post('/threads', $thread->toArray());

        // And when we visit the thread page
        $this->get('/threads')
         // Then we should see the new thread's title and body
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}


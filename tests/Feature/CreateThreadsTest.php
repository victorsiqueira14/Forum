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
    private $user;
    use DatabaseMigrations;

    // public function test_guests_may_not_create_a_threads()
    // {
    //     //
    // }

    public function test_an_authenticated_user_can_create_new_forum_threads()

    {

        $this->withoutExceptionHandling();

        $this->signIn();

        $thread = Thread::factory()->create();

        $this->post('/threads', $thread->toArray());

        $this->get('/threads')
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }


}


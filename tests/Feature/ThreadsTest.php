<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{

    use DatabaseMigrations;

    public function test_a_user_can_browse_threads()
    {
        $user = User::factory()->create();
        $thread = Thread::factory()->create();

        $response = $this->get('/threads');

        $response->assertSee($thread->title);
    }

    public function test_a_user_can_read_a_single_thread()
    {
        $user = User::factory()->create();
        $thread = Thread::factory()->create();

        $response = $this->get('/threads/' . $thread->id);

        $response->assertSee($thread->title);

    }



}





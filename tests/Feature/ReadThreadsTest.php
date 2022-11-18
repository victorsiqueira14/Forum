<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    private $thread;
    private $user;


    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->thread = Thread::factory()->create();
    }

    public function test_a_user_can_browse_threads()
    {
        $this
        ->get('threads')
        ->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_a_single_thread()
    {
            $this->get('/threads/'. $this->thread->id)
            ->assertSee($this->thread->title);

    }

    public function test_a_user_can_replies_that_are_associated_with_a_thread()
    {
        $reply = Reply::factory()
            ->create(['thread_id' => $this->thread->id]);

        $this->get('/threads/'. $this->thread->id)
            ->assertSee($reply->body);
    }



}





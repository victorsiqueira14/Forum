<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
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
        $this->reply = Reply::factory()->create();
    }

    public function test_a_user_can_browse_threads()
    {
        $this
        ->get('threads')
        ->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_a_single_thread()
    {

            $thread = Thread::factory()->create();
            $channel = Channel::factory()->create();

            $this->get('/threads/'.$this->thread->path())
            ->assertSee($this->thread->title);

    }


    public function test_a_user_can_replies_that_are_associated_with_a_thread()
    {
        $channel = Channel::factory()->create();

        $this->get('/threads/'.$this->thread->path())
            ->assertSee($this->reply->body);
    }




}


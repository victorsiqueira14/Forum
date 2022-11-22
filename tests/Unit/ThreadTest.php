<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {

        parent::setUp();
        $this->user = User::factory()->create();
        $this->thread = Thread::factory()->create();
        $this->channel = Channel::factory()->create();

    }


    function test_a_thread_has_replies()
    {

        $this->assertInstanceOf(Collection::class, $this->thread->replies);

    }

    public function test_a_thread_has_a_creator()
    {

        $this->assertInstanceOf(User::class, $this->thread->creator);

    }

    public function test_a_thread_can_add_a_reply()
    {

        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1,
        ]);

        $this->assertCount(1, $this->thread->replies);

    }

    public function test_a_thread_belongs_to_a_channel()
    {

        $thread = Thread::factory()->create();
        $channel = Channel::factory()->create();

        $this->assertInstanceOf(Channel::class, $this->thread->channel);

    }

    public function test_a_thread_can_make_a_string_path()
    {

        $this->assertEquals("{$this->channel->slug}/{$this->thread->id}", $this->thread->path());

    }

}


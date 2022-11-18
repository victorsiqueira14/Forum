<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{

    use DatabaseMigrations;

    protected $thread;

    public function setUp(): void
    {
        parent::setUp();
        $this->be($user = User::factory()->create());
        $this->thread = Thread::factory()->create();
        $this->reply = Reply::factory()->create();
    }

    // public function test_unauthenticaded_users_may_not_add_replies()
    // {
    //     $this->expectException(AuthenticationException::class);
    //     $this->withoutExceptionHandling();
    //     $this->post('/threads/'.$this->thread->id.'/replies', $this->reply->toArray());

    // }

    public function test_an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->post('/threads/'.$this->thread->id.'/replies', $this->reply->toArray());
        $this->get('/threads/'. $this->thread->id)
            ->assertSee($this->reply->body);

    }
}




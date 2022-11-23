<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{

    use DatabaseMigrations;



    public function setUp(): void
    {
        parent::setUp();
        $this->be($user = User::factory()->create());
        $this->thread = Thread::factory()->create();
        $this->reply = Reply::factory()->create();
        $this->channel = Channel::factory()->create();
    }

    // public function test_unauthenticaded_users_may_not_add_replies()
    // {
    //     $this->withExceptionHandling()
    //         ->post('/threads/some-channel/1/replies', [])
    //         ->assertRedirect('/login');

    // }

    public function test_an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->signIn();

        $thread = Thread::factory()->create();
        $reply = Reply::factory()->make();

        $this->post('/threads/'.$this->thread->path().'/replies', $reply->toArray());

        $this->get('/threads/'.$this->thread->path())
            ->assertSee($reply->body);
    }

    public function test_a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = Thread::factory()->create();
        $reply = Reply::factory()->make(['body' => null]);


        $this->post('/threads/'.$this->thread->path().'/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }


}




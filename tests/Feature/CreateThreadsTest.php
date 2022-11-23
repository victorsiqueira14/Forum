<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
    private $user;
    use DatabaseMigrations;

    public function test_guests_may_not_create_a_threads()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');
    }

    public function test_an_authenticated_user_can_create_new_forum_threads()

    {
   
        $this->signIn();

        $channel = Channel::factory()->create();
        $thread = Thread::factory()->make();


        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function publishThreads($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = Thread::factory()->make($overrides);

        return $this->post('/threads', $thread->toArray());

    }

    public function test_a_threads_requires_a_title()
    {

        $this->publishThreads(['title' => null])
            ->assertSessionHasErrors('title');

    }

    public function test_a_threads_requires_a_body()
    {

        $this->publishThreads(['body' => null])
            ->assertSessionHasErrors('body');

    }

    public function test_a_threads_requires_a_valid_channel()
    {
        Channel::factory(2)->create();

        $this->publishThreads(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThreads(['channel_id' => 999])
        ->assertSessionHasErrors('channel_id');

    }





}


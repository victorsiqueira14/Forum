<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
use App\Models\Activity;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
    private $user;
    use DatabaseMigrations;

    /**
     * SetUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->thread = Thread::factory()->create();
        $this->reply = Reply::factory()->create();
        $this->channel = Channel::factory()->create();
    }

    /**
     * guests may not create a thread
     *
     * @return void
     */
    public function test_guests_may_not_create_a_threads()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');
    }

    /**
     * an authrenticated use can create new forum threads
     *
     * @return void
     */
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


    /**
     * Publish Threads
     *
     * @param array $overrides
     */
    public function publishThreads($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = Thread::factory()->make($overrides);

        return $this->post('/threads', $thread->toArray());
    }

    /**
     * threads requires a title
     *
     * @return void
     */
    public function test_a_threads_requires_a_title()
    {
        $this->publishThreads(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /**
     * Threads requires a body
     *
     * @return void
     */
    public function test_a_threads_requires_a_body()
    {
        $this->publishThreads(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /**
     * threads requires a valid channel
     *
     * @return void
     */
    public function test_a_threads_requires_a_valid_channel()
    {
        Channel::factory(2)->create();

        $this->publishThreads(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThreads(['channel_id' => 999])
        ->assertSessionHasErrors('channel_id');
    }

    /**
     * unauthorizade users may not delete threads
     *
     * @return void
     */
    public function test_unauthorized_users_may_not_delete_threads()
    {
        $this->withExceptionHandling();

        $this->delete('/threads/'.$this->thread->path())
            ->assertRedirect('/login');

        $this->signIn();
        $this->delete('/threads/'.$this->thread->path())
            ->assertStatus(403);
    }

    /**
     * authorized users delete threads
     *
     * @return void
     */
    public function test_authorized_users_can_delete_threads()
    {
        $this->signIn();

        $thread = Thread::factory()->create(['user_id' => auth()->id()]);
        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        $response =  $this->delete('/threads/'.$this->thread->path(), $thread->toArray());
        $response->assertStatus(403);

        $this->assertSoftDeleted('threads', [
            'id' => $thread->id,
        ]);

        $this->assertSoftDeleted('replies', $this->reply->only('id'));

        $this->assertSoftDeleted('activities', [
            'subject_id' => $this->reply->only('id'),
            'subject_type' => get_class($this->thread),
        ]);

        $this->assertSoftDeleted('activities', [
            'subject_id' => $reply->only('id'),
            'subject_type' => get_class($reply)
        ]);
    }
}

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

    /**
     * A setup Function for test
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->thread = Thread::factory()->create();
        $this->reply = Reply::factory()->create();
    }

    /**
     *
     * @return void
     */
    public function test_a_user_can_browse_threads()
    {
        $this
        ->get('threads')
        ->assertSee($this->thread->title);
    }

    /**
     *
     * @return void
     */
    public function test_a_user_can_read_a_single_thread()
    {
            $thread = Thread::factory()->create();
            $channel = Channel::factory()->create();

            $this->get('/threads/'.$this->thread->path())
            ->assertSee($this->thread->title);
    }

    /**
     *
     * @return void
     */
    public function test_a_user_can_replies_that_are_associated_with_a_thread()
    {

        $channel = Channel::factory()->create();

        $this->get('/threads/'.$this->thread->path())
            ->assertSee($this->reply->body);

    }

    /**
     *
     * @return void
     */
    public function test_a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = Channel::factory()->create();
        $threadInChannel = Thread::factory()->create(['channel_id' => $channel->id]);
        $threadNotInChannel = Thread::factory()->make();

        $this->get('/threads/'.$channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);

    }

    /**
     *
     * @return void
     */
    public function test_a_user_can_filter_threads_by_any_username()
    {
        $this->withExceptionHandling();
        $this->signIn(User::factory()->create(['name' => 'JohnDoe']));

        $threadByJohnDoe = Thread::factory()->create(['user_id' => auth()->id()]);
        $threadNotByJohnDoe = Thread::factory()->make();

        $this->get('threads?by=JohnDoe')
            ->assertSee($threadByJohnDoe->title)
            ->assertDontSee($threadNotByJohnDoe->title);

    }


    /**
     * Given we have three threads, With 2 replies, 3 replies, and 0 replies, respectively
     * Given wewhem i filter all threads by popularity have three threads, With 2 replies, 3 replies, and 0 replies, respectively
     * then they should be returned from most replies to least
     *
     * @return void
     */
    public function test_a_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReplies = Thread::factory()
            ->hasReplies(2)
            ->create();

        $threadWithThreeReplies = Thread::factory()
            ->hasReplies(3)
            ->create();

        $threadWithZeroReplies = Thread::factory()->create();

        $this->get('threads?popular=1')
            ->assertSeeInOrder([
                $threadWithTwoReplies->title,
                $threadWithThreeReplies->title,
                $threadWithZeroReplies->title
        ]);
    }
}


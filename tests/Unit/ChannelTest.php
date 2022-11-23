<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_channel_consists_of_threads()
    {
        $user = User::factory()->create();
        $channel = Channel::factory()->create();
        $thread = Thread::factory()->create(['channel_id' => $channel->id]);

        $this->assertTrue($channel->threads->contains($thread));

    }

}

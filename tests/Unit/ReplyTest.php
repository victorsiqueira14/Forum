<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    function test_it_has_an_owner(){
         $this->user = User::factory()->create();
         $this->assertInstanceOf(User::class,
            Reply::factory()->create()->owner);
    }

}

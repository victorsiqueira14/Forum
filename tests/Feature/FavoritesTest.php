<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Favorite;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    public function test_guest_can_not_favorite_anything()
    {
        $this->withExceptionHandling()
            ->post('replies/1/favorites')
            ->assertRedirect('/login');
    }

    /**
     * if i post to a "favorite" endpoint, It shold be recorded in the database
     *
     * @return void
     */
    public function test_an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        $reply = Reply::factory()->create();

        $this->post('replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }

    /**
     *
     * @return void
     */
    public function test_an_authenticated_user_may_only_favorite_a_reply_once()
    {
        $this->signIn();

        $reply = Reply::factory()->create();

        try {
            $this->post('replies/' . $reply->id . '/favorites');
            $this->post('replies/' . $reply->id . '/favorites');
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert the same record set twice.');
        }

        $this->assertCount(1, $reply->favorites);
    }

}

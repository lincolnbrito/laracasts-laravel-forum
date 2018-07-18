<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_cannot_favorite_anything()
    {
        // If a user post to a "favorite" endpoint
        $this->withExceptionHandling()
            ->post('replies/1/favorites')
            ->assertRedirect('/login');
    }


    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        //replies/id/favorites
        $reply = create('App\Reply');

        // If a user post to a "favorite" endpoint
        $this->post('replies/'.$reply->id.'/favorites');

        // It should be recorded in the database
        $this->assertCount(1, $reply->favorites);
    }
}

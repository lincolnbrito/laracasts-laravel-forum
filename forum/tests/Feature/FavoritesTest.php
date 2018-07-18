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

    /** @test */
    public function an_authenticated_user_may_only_favorite_a_reply_once()
    {
        $this->signIn();

        //replies/id/favorites
        $reply = create('App\Reply');

        try{
            // If a user post to a "favorite" endpoint
            $this->post('replies/'.$reply->id.'/favorites');
            $this->post('replies/'.$reply->id.'/favorites');
        }catch (\Exception $e) {
            $this->fail('Did not expect to insert same record set twice');
        }


        // It should be recorded in the database
        $this->assertCount(1, $reply->favorites);
    }
}

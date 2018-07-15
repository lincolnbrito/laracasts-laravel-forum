<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guest_may_not_create_threads()
    {

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = make('App\Thread');
        
        $this->post('/threads', $thread->toArray());   
    }

    /** @test */
    function an_authenticated_user_can_create_forum_threads()
    {
        // Given we have a signed user
        $this->signIn();
        
        // Whe we hit the endpoint to create a new thread
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());

        // Then, when we visit the thread page.
        // We should see the new thread
        $this->get($thread->path())
             ->assertSee($thread->title)
             ->assertSee($thread->body);

    }
}

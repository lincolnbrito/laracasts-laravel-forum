<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends TestCase
{
    /** @test */
    function an_authenticated_user_can_create_forum_threads()
    {
        // Giver we have a signed user
        // Whe we hit the endpoint to create a new thread
        // Then, when we visit the thread page.
        // We should see the new thread
    }
}

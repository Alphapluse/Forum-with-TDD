<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    function unauthenticated_users_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('/replies/1/replies', []);

    }
    /**
     *  @test
     */

     function an_authenticated_user_may_participate_in_forum_threads()
     {

        $this->be($user = factory('App\User')->create());

        $thread = factory('App\Thread')->create();


        $reply = factory('App\Reply')->make();

        $this->post($thread->path().'/replies', $reply->toArray());


        $this->get($thread->path())
           ->assertSee($reply->body);
     }

}

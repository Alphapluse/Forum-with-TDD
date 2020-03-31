<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ThreadTest extends TestCase
{
   use DatabaseMigrations;
    protected $thread;

   public function setUpTraits()
   {
       Parent::setUpTraits();

       $this->thread = factory('App\Thread')->create();
   }

    public function a_thread_has_replies()
    {

        $thread = factory('App\Thread')->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    function a_thread_has_creator()
    {
        $thread =  factory('App\Thread')->create();

        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}

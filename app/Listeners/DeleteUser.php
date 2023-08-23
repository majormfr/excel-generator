<?php

namespace App\Listeners;

use App\Events\InterviewCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
        
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\InterviewCreated  $event
     * @return void
     */
    public function handle(InterviewCreated $event)
    {
        //
        $user = $event->interview;
        echo($user->name);
    }
}

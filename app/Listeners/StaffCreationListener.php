<?php

namespace App\Listeners;

use App\Events\StaffCreationEvent;
use App\Mail\StaffCreationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StaffCreationListener
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
     * @param  \App\Events\StaffCreationEvent  $event
     * @return void
     */
    public function handle(StaffCreationEvent $event)
    {
        Mail::to($event->maildata['email'])->send(new StaffCreationMail($event->maildata));
    }
}

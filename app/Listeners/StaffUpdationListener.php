<?php

namespace App\Listeners;

use App\Events\StaffUpdationEvent;
use App\Mail\StaffUpdationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StaffUpdationListener
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
     * @param  \App\Events\StaffUpdationEvent  $event
     * @return void
     */
    public function handle(StaffUpdationEvent $event)
    {
        Mail::to($event->maildata['email'])->send(new StaffUpdationMail($event->maildata));
    }
}

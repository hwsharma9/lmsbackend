<?php

namespace App\Listeners;

use App\Events\AdminAccountCreationEvent;
use App\Mail\AdminAccountCreation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class AdminAccountCreationListener
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
     * @param  \App\Events\AdminAccountCreationEvent  $event
     * @return void
     */
    public function handle(AdminAccountCreationEvent $event)
    {
        Mail::to($event->user->email)
            ->send(new AdminAccountCreation($event->user, $event->password, $event->subject));
    }
}

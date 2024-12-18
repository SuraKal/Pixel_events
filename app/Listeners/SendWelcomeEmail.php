<?php

namespace App\Listeners;

use App\Mail\WelcomeEmail;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        //
         // Send the welcome email to the user who registered
        Mail::to($event->user->email)->send(mailable: new WelcomeEmail($event->user));
    }
}

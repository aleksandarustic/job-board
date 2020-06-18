<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Support\Facades\Mail;


/**
 * MailSent: This Lister react to SendMail event
 */
class MailSent
{

    /**
     * Handle the event.
     * Executes this function when SendMail event is occured
     * Sends mail to user from SendMail event object
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        try {
            Mail::to($event->to)->cc($event->cc)->send($event->mail);
        } catch (\Exception $e) {
            var_dump($e);
        }
    }
}

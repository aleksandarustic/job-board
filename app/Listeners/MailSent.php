<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Support\Facades\Mail;


class MailSent
{

    /**
     * Handle the event.
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

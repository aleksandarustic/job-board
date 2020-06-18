<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

use Illuminate\Mail\Mailable;


/**
 * SendMail: Event that notify Mail Sent listener to send mail .
 */
class SendMail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $to;
    public $mail;
    public $cc;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Mailable $mail, $to = [], $cc = [])
    {
        $this->mail = $mail;
        $this->to = $to;
        $this->cc = $cc;
    }
}

<?php

namespace App\Mail;

use App\Job;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * ManagerMail: Mailable object to manager
 */
class ManagerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $job;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    /**
     * Build the message With access to $job variable
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.manager.index');
    }
}

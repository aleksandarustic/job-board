<?php

namespace App\Mail;

use App\Job;
use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * ModeratorMail: Mailable object to Moderator
 */
class ModeratorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $job;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Job $job, User $user)
    {
        $this->job = $job;
        $this->user = $user;
    }

    /**
     * Build the message with access to $job and $user
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.moderator.index');
    }
}

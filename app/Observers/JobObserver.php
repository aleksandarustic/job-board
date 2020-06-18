<?php

namespace App\Observers;

use App\Job;
use App\User;
use App\Events\SendMail;
use App\Mail\ManagerMail;
use App\Mail\ModeratorMail;

class JobObserver
{
    public function created(Job $job)
    {
        if ($job->status == 'pending') {

            event(new SendMail(new ManagerMail($job), $job->user));

            $moderator = User::where('role', 'moderator')->first();

            if ($moderator) {
                event(new SendMail(new ModeratorMail($job, $moderator), $moderator));
            }
        }
    }
}

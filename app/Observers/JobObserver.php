<?php

namespace App\Observers;

use App\Job;
use App\User;
use App\Events\SendMail;
use App\Mail\ManagerMail;
use App\Mail\ModeratorMail;

/**
 * JobObserver: This class watch for changes in jobs and execut functions affter event occurs
 */
class JobObserver
{
    /**
     * created: Execute affter instance of Job is created.
     * Check if status is pending which mean if this is manager first job send notification to manager and moderator
     *
     * @param  mixed $job
     * @return void
     */
    public function created(Job $job)
    {
        if ($job->status == 'pending') { // Check if status is pending

            // Dispatch event for sending mail
            event(new SendMail(new ManagerMail($job), $job->user)); 

            // Gets moderator if exists
            $moderator = User::where('role', 'moderator')->first(); 

            // Send notification to moderator if moderator exists
            if ($moderator) {
                event(new SendMail(new ModeratorMail($job, $moderator), $moderator)); 
            }
        }
    }
}

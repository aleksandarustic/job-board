<?php

namespace App\Repository\Eloquent;

use App\Job;
use App\Repository\JobRepositoryInterface;

use Illuminate\Support\Facades\Auth;

/**
 * JobRepository: Contain main logic and operation for manipulation with job offers
 */
class JobRepository extends BaseRepository implements JobRepositoryInterface
{

    /**      
     * BaseRepository constructor.      
     *      
     * @param Job $model      
     */
    public function __construct(Job $model)
    {
        parent::__construct($model);
    }

    /**
     * approve: This function finds job with passed token and set status to approved and remove token from job model
     *
     * @param  mixed $token
     * @return void
     */
    public function approve($token)
    {
        $job = $this->model->where('token', $token)->first();
        if ($job) {
            $job->status = 'approved';
            $job->token = null;
            $job->save();
        }

        return $job;
    }

    /**
     * reject:This function finds job with passed token and set status to rejected and remove token from job model
     *
     * @param  mixed $token
     * @return void
     */
    public function reject($token)
    {
        $job = $this->model->where('token', $token)->first();
        if ($job) {
            $job->status = 'rejected';
            $job->token = null;
            $job->save();
        }

        return $job;
    }


    /**
     * createJob: This function fill job with validated inputs ,and create token if this is first job for manager. 
     *
     * @param  mixed $data
     * @return void
     */
    public function createJob($data)
    {
        $model = new $this->model;
        // Add Auth user id to job
        $model->user_id = Auth::id();
        $model->fill($data);

        if ($this->isFirst($model->user_id)) { // Check if this is first job
            // Create random token
            $model->token = $this->createToken();
            $model->status = 'pending';
        } else {
            $model->status = 'approved';
        }

        return $model->save();
    }

    /**
     * createToken: Create random token that will be use in mail to approve and reject job offer posting
     *
     * @return void
     */
    private function createToken()
    {
        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while ($this->model->where('token', $token)->first());

        return $token;
    }


    /**
     * isFirst: Checks if this is first job for manager
     *
     * @param  mixed $user_id
     * @return void
     */
    private function isFirst($user_id)
    {
        return !$this->model->where('user_id', $user_id)->exists();
    }
}

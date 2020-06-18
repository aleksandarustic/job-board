<?php

namespace App\Repository\Eloquent;

use App\Job;
use App\Repository\JobRepositoryInterface;

use Illuminate\Support\Facades\Auth;


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


    public function createJob($data)
    {
        $model = new $this->model;
        $model->user_id = Auth::id();
        $model->fill($data);

        if ($this->isFirst($model->user_id)) {
            $model->token = $this->createToken();
            $model->status = 'pending';
        } else {
            $model->status = 'approved';
        }

        return $model->save();
    }

    private function createToken()
    {
        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while ($this->model->where('token', $token)->first());

        return $token;
    }


    private function isFirst($user_id)
    {
        return !$this->model->where('user_id', $user_id)->exists();
    }
}

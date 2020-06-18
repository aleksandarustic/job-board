<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * JobController
 */
class JobController extends Controller
{

    /**
     * repo: inject JobRepository
     *
     * @var mixed
     */
    private $repo;

    /**
     * Create a new controller instance.
     * Injects JobRepository
     *
     * @return void
     */
    public function __construct(\App\Repository\JobRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }


    /**
     * Returns all job offers in case that auth user is mediator and job offers that own manager is user is manager
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $jobs = Job::orderBy('created_at', 'desc');

        if (Auth::user()->role == 'manager') {
            $jobs->where('user_id', Auth::user()->id);
        }

        return view('jobs.index')->with('jobs', $jobs->paginate(10));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     * Check if all input is valid with request object
     * Redirect to home page with message is job succesfuly created
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\Job\Store $request)
    {

        if ($this->repo->createJob($request->validated())) {

            return redirect()->route('home')->with('message', 'Job Offer has been successfuly created');
        } else {

            return redirect()->route('home');
        }
    }
    
    /**
     * approve: Changes status of job offer to approved if token exists in database 
     *
     * @param  mixed $token
     * @return void
     */
    public function approve($token)
    {
        if ($this->repo->approve($token)) {
            return view('notifications.index')->with('message', 'Job Offer has been approved');
        } else {
            return view('notifications.index')->with('error', 'Requested token is not valid');
        }
    }

    
    /**
     * reject: Changes status of job offer to reject if token exists in database 
     *
     * @param  mixed $token
     * @return void
     */
    public function reject($token)
    {

        if ($this->repo->reject($token)) {
            return view('notifications.index')->with('message', 'Job Offer has been rejected');
        } else {
            return view('notifications.index')->with('error', 'Requested token is not valid');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}

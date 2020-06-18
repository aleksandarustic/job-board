<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{

    private $repo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(\App\Repository\JobRepositoryInterface $repo)
    {
        $this->repo = $repo;

        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $jobs = Job::orderBy('created_at', 'desc')->paginate(10);

        return view('jobs.index')->with('jobs', $jobs);
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

        // $job = new Job;

        // $data = $request->validated();
        // $data['user_id'] = $request->user()->id;

        // if ($job->create($data)) {
        //     return redirect()->route('home')->with('message', 'Job has been successfuly created');
        // } else {
        //     return redirect()->route('home');
        // }
    }

    public function approve($token)
    {
        if ($this->repo->approve($token)) {
            return view('notifications.index')->with('message', 'Job Offer has been approved');
        } else {
            return view('notifications.index')->with('error', 'Requested token is not valid');
        }
    }


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

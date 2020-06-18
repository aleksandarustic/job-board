<?php

namespace App\Http\Controllers;


/**
 * HomeController
 */
class HomeController extends Controller
{    
    /**
     * index: Returns approved Job offers from database and show home page
     *
     * @return void
     */
    public function index()
    {

        $jobs = \App\Job::where('status', 'approved')->paginate(4);

        return view('index')->with('jobs', $jobs);
    }
}

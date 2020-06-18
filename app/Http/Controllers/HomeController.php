<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index()
    {

        $jobs = \App\Job::where('status', 'approved')->paginate(4);

        return view('index')->with('jobs', $jobs);
    }
}

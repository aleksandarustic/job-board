<?php

namespace App\Http\Controllers;


class PagesController extends Controller
{
    public function mainpage()
    {
        return view('index');
    }
}

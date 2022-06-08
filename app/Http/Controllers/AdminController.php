<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Show dashboard page
    public function Dashboard(){
        return view('backend.layouts.index');
    }
}

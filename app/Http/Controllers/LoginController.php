<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    
    public function client()
    {
        return view('external.clientLogin');
    }

    public function worker()
    {
        return view('external.workerLogin');
    }

}

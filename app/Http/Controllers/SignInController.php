<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SignInController extends Controller
{
    public function signin()
    {
        return view('external.signin');
    }
}

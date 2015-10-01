<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home()
    {
        return view('external.home');
    }

    public function about()
    {
        return view('external.about');
    }

    public function modules()
    {
        return view('external.modules');
    }

    public function calendar()
    {
        return view('external.calendar');
    }

    public function clientHome()
    {
        return view('internal.client.home');
    }

    public function salesmanHome()
    {
        return view('internal.salesman.home');
    }

    public function promoterHome()
    {
        return view('internal.promoter.home');
    }

    public function adminHome()
    {
        return view('internal.admin.home');
    }

}

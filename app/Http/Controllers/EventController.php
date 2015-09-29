<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class EventController extends Controller
{
    public function index()
    {
        return view('external.events');
    }

    public function show($id)
    {
        return view('external.event');
    }

    public function newEvent()
    {
        return view('internal.promoter.newEvent');
    }

    public function editEvent()
    {
        return view('internal.promoter.editEvent');
    }

    public function promoterRecord()
    {
        return view('internal.promoter.record');
    }

    public function clientRecord()
    {
        return view('internal.client.record');
    }

    public function addFunction()
    {
        return view('internal.promoter.addFunction');
    }

    public function clientBuy($id)
    {
        $user = Auth::user();

        return view('internal.client.buy')->with('user',$user);
    }

    public function successBuy()
    {
        return view('internal.client.successBuy');
    }

    public function salesmanBuy($id)
    {
        $user = Auth::user();

        return view('internal.salesman.buy')->with('user',$user);
    }

    public function reserve($id)
    {
        return view('internal.client.reserve');
    }

    public function clientHome()
    {
        return view('internal.client.home');
    }
    public function politics()
    {
        return view('internal.promoter.politics');
    }
    public function recordPayment()
    {
        return view('internal.promoter.recordPayment');
    }
}

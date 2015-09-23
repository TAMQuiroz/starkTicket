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

    public function salesmanBuy($id)
    {
        $user = Auth::user();
        
        return view('internal.salesman.buy')->with('user',$user);
    }

    public function reserve($id)
    {
        return view('internal.client.reserve');
    }

    public function clientProfile()
    {
        return view('internal.client.profile');
    }
}

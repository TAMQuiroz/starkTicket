<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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

    public function create()
    {
        return view('internal.promoter.createEvent');
    }

    public function promoterRecord()
    {
        return view('internal.promoter.record');
    }

    public function clientRecord()
    {
        return view('internal.salesman.record');
    }

    public function addFunction()
    {
        return view('internal.promoter.addFunction');
    }
}

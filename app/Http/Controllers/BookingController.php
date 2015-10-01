<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
	public function create($id)
	{
		return view('external.booking.create');
	}

	public function store(Request $request)
	{
		
		//return view('external.home');
		return view('external.booking.results');
	}
	
	public function pay($id)
	{
		return view('internal.salesman.payBooking');
	}

}
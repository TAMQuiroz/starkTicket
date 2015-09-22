<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BusinessController extends Controller
{
    public function cashCount()
    {
        return view('internal.salesman.cashCount');
    }

    public function ticketReturn()
    {
        return view('internal.admin.ticketReturn');
    }

    public function exchangeRate()
    {
        return view('internal.admin.exchangeRate');
    }

    public function transferPayments()
    {
        return view('internal.promoter.transferPayments');
    }

    public function promotion()
    {
        return view('internal.promoter.promotions');
    }

    public function config()
    {
        return view('internal.admin.config');
    }
}

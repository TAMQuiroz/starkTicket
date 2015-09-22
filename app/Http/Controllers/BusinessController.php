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

    public function transferPayments()
    {
        return view('internal.promoter.transferPayments');
    }

    public function promotion()
    {
        return view('internal.promoter.promotions');
    }
}

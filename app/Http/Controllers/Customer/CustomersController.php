<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class CustomersController extends Controller
{
    public function current()
    {
        return Auth::guard('customer')->user();
    }
}

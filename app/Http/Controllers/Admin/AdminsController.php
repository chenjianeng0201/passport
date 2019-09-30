<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;

class AdminsController extends Controller
{
    public function current()
    {
        return Auth::guard('admin')->user();
    }
}

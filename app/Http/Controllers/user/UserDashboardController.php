<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function userDashboard()
    {
        $userOrders = auth()->user()->orders;
        return view('userDasboard.index', compact('userOrders'));
    }
}

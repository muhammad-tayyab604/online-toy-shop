<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function adminIndex()
    {
        $customers = User::where('role', 'user')->paginate(10);
        $orders = Order::where('payment_status', 'paid')->paginate(10);
        return view('admin.Index.index', compact('customers', 'orders'));
    }
}

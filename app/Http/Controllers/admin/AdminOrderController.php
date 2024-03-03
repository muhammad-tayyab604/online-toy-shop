<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function Orders()
    {
        $orders = Order::all();
        return view('admin.Orders.index', compact('orders'));
    }
}

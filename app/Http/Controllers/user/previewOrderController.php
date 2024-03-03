<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class previewOrderController extends Controller
{
    public function previewOrder($id)
    {
        $order = Order::findOrFail($id);
        return view('userDasboard.userPreviewOrder.index', compact('order'));
    }
}

<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Toys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function storeOrderDetails(Request $request, Toys $toy)
    {
        $request->validate([
            'phone_number' => 'required',
            'address' => 'required',
            'toy_id' => 'required|exists:toys,id', // Validate that the toy_id exists in the toys table
        ]);
        $order = new Order();
        $order->phone_number = $request->phone_number;
        $order->address = $request->address;
        $order->toy_id = $request->toy_id;
        $order->user_id = auth()->user()->id;
        // dd($request->toy_id);
        $order->save();
        return redirect()->route('user.dashboard')->with('successOrder', 'Your order has been placed successfully, You can click on Pay Now, to make payments');
    }

    // Cancel the order
    public function cancelOrder($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->status = 'cancelled';
            $order->save();

            return redirect('/user/dashboard')->with('message', 'Your order has been canceled. This order will be deleted by the admin.');
        } else {
            return redirect()->back()->with('error', 'Order not found.');
        }
    }
}

<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class StripeSuccessController extends Controller
{
    public function stripeSuccess($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->payment_status = 'paid';
            $order->save();
        }
        return view("Stripe.success");
    }
}

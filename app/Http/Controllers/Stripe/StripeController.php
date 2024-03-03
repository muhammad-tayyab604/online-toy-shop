<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function session($id, Request $request)
    {
        try {
            \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));

            $toyName = $request->get('toyName');
            $totalprice = $request->get('price');
            $two0 = "00";
            $total = "$totalprice$two0";

            $user = auth()->user();

            $session = \Stripe\Checkout\Session::create([
                'customer_email' => $user->email,
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'PKR',
                            'product_data' => [
                                "name" => $toyName,
                            ],
                            'unit_amount' => $total,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('stripe.success', $id),
                'cancel_url' => route('user.dashboard'),
            ]);

            return redirect()->away($session->url);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Toys;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout($id)
    {
        $checkout = Toys::findOrFail($id);
        $toys = Toys::all();
        return view("checkout.checkout", compact("checkout", "toys"));
    }

}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Toys;
use Illuminate\Http\Request;

class orderPreview extends Controller
{
    public function orderPreview($id)
    {
        $order = Order::findOrFail($id);
        return view("admin.Orders.orderPreview.index", compact('order'));
    }

    // Delete order by admin from database
    public function deleteOrder($id)
    {
        $toy = Toys::findOrFail($id);

        // Delete related orders
        $toy->orders()->delete();

        // Delete the toy
        $toy->delete();
        return redirect('/all/orders')->with('success', 'The order has been deleted from Database');
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Top selling Items report
        $topSellingItems = Order::select('toy_id', DB::raw('count(*) as order_count'))
            ->groupBy('toy_id')
            ->orderByDesc('order_count')
            ->paginate(10);

        // Top Customers
        $roleName = 'user';

        $perPage = 10;

        $customers = User::withCount('orders')
            ->role($roleName)
            ->orderByDesc('orders_count')
            ->paginate($perPage);

        // Sales report
        $orders = Order::where('payment_status', 'paid')->paginate(10);

        // Calculate total price for each order
        $totalPrice = 0;


        return view("admin.Reports.index", compact('topSellingItems', 'customers', 'orders', 'totalPrice'));
    }

    // Generate Report
    public function downloadReportPdf()
    {

    }

}

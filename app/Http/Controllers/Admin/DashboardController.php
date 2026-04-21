<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Models\Order;
use App\Models\Client;

class DashboardController extends Controller {
    public function index() {
        $startOfMonth = now()->startOfMonth();
        $stats = [
            'total_workers'      => Worker::count(),
            'available_workers'  => Worker::where('status','available')->count(),
            'total_orders'       => Order::count(),
            'total_clients'      => Client::count(),
            'workers_this_month' => Worker::where('created_at', '>=', $startOfMonth)->count(),
            'orders_this_month'  => Order::where('created_at', '>=', $startOfMonth)->count(),
            'clients_this_month' => Client::count() > 0 ? Client::where('created_at', '>=', $startOfMonth)->count() : 0,
        ];
        $recentOrders = Order::with(['client','worker'])->latest()->take(10)->get();
        return view('admin.dashboard', compact('stats','recentOrders'));
    }
}

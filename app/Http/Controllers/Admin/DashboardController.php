<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Models\Order;
use App\Models\Client;

class DashboardController extends Controller {
    public function index() {
        $stats = [
            'total_workers' => Worker::count(),
            'available_workers' => Worker::where('status','available')->count(),
            'total_orders' => Order::count(),
            'total_clients' => Client::count(),
        ];
        $recentOrders = Order::with(['client','worker'])->latest()->take(10)->get();
        return view('admin.dashboard', compact('stats','recentOrders'));
    }
}

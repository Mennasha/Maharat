<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function index() {
        $client = Auth::user()->client;
        $orders = $client ? $client->orders()->with('worker')->latest()->get() : collect();
        return view('client.dashboard', compact('orders','client'));
    }
}

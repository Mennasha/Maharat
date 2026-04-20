<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTimeline;
use Illuminate\Http\Request;

class OrderController extends Controller {
    public function index() {
        $orders = Order::with(['client','worker'])->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order) {
        $order->load(['client','worker','timeline']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order) {
        $request->validate([
            'status' => 'required|in:contracted,visa_processing,training,ticket_booked,arrived',
            'description' => 'nullable|string',
        ]);

        $order->update(['status' => $request->status]);

        OrderTimeline::create([
            'order_id' => $order->id,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'تم تحديث حالة الطلب بنجاح');
    }
}

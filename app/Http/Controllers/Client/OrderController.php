<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\OrderTimeline;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller {
    public function create(Request $request) {
        $worker = null;
        if ($request->worker_id) {
            $worker = Worker::where('status', 'available')->findOrFail($request->worker_id);
        }
        $availableWorkers = Worker::where('status', 'available')->get();
        return view('client.orders.create', compact('worker', 'availableWorkers'));
    }

    public function store(Request $request) {
        $request->validate([
            'worker_id' => 'required|exists:workers,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        $client = Auth::user()->client;
        if (!$client) {
            return back()->withErrors(['error' => 'لم يتم العثور على بيانات حسابك، تواصل مع الدعم.']);
        }

        $worker = Worker::where('status', 'available')->findOrFail($request->worker_id);

        $order = Order::create([
            'client_id' => $client->id,
            'worker_id' => $worker->id,
            'notes' => $request->notes,
            'status' => 'contracted',
        ]);

        $worker->update(['status' => 'reserved']);

        OrderTimeline::create([
            'order_id' => $order->id,
            'status' => 'contracted',
            'description' => 'تم إنشاء الطلب',
        ]);

        try {
            $order->load(['client', 'worker']);
            if ($order->client?->user?->email) {
                Mail::to($order->client->user->email)->send(new OrderPlaced($order));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send order confirmation email for order #' . $order->id . ': ' . $e->getMessage());
        }

        return redirect()->route('client.orders.show', $order)->with('success', 'تم إرسال طلبك بنجاح، سيتواصل معك فريقنا قريباً.');
    }

    public function show(Order $order) {
        if ($order->client_id !== Auth::user()->client?->id) {
            abort(403);
        }
        $order->load(['worker', 'timeline']);
        return view('client.orders.show', compact('order'));
    }
}

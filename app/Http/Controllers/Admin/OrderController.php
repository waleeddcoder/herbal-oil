<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $orders = $query->paginate(20);
        return view('admin.orders', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,shipped,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);
        return redirect()->route('admin.orders.index')->with('success', "Order #{$order->id} status updated to " . ucfirst($validated['status']) . ".");
    }

    public function destroy(Order $order)
    {
        $orderId = $order->id;
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', "Order #{$orderId} deleted successfully.");
    }
}

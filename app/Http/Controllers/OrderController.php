<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $product = Product::first();
        if (!$product) {
            return redirect()->back()->withErrors(['error' => 'Product not available at this time.']);
        }

        $total_price = $product->price * $data['quantity'];

        Order::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'quantity' => $data['quantity'],
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        return redirect()->route('home', ['#order'])->with('order_success', 'Your order has been placed successfully! We will contact you soon.');
    }
}

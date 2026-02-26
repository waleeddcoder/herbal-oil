<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_price');
        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalOrders', 'pendingOrders', 'totalRevenue', 'recentOrders'));
    }
}

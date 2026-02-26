@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-2xl shadow-sm ring-1 ring-slate-200">
        <h3 class="text-sm font-medium text-slate-500">Total Orders</h3>
        <p class="text-3xl font-bold text-slate-900 mt-2">{{ $totalOrders }}</p>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm ring-1 ring-slate-200">
        <h3 class="text-sm font-medium text-slate-500">Pending Orders</h3>
        <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingOrders }}</p>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm ring-1 ring-slate-200">
        <h3 class="text-sm font-medium text-slate-500">Revenue</h3>
        <p class="text-3xl font-bold text-green-600 mt-2">Rs. {{ number_format($totalRevenue, 0) }}</p>
    </div>
</div>

<div class="mt-8">
    <h3 class="text-lg font-semibold text-slate-900 mb-4">Recent Orders</h3>
    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Order ID</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($recentOrders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">#{{ $order->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $order->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-1 text-xs font-medium rounded-full
                            {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800 ring-1 ring-inset ring-yellow-600/20' : '' }}
                            {{ $order->status == 'confirmed' ? 'bg-blue-100 text-blue-800 ring-1 ring-inset ring-blue-600/20' : '' }}
                            {{ $order->status == 'shipped' ? 'bg-green-100 text-green-800 ring-1 ring-inset ring-green-600/20' : '' }}
                            {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800 ring-1 ring-inset ring-red-600/20' : '' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">Rs. {{ number_format($order->total_price, 0) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $order->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-500">No orders yet. Orders will appear here once customers start shopping.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

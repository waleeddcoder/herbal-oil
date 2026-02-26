@extends('admin.layout')
@section('title', 'Manage Orders')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex items-center space-x-2">
        <span class="text-sm font-medium text-slate-700">Filter Status:</span>
        <div class="flex bg-white rounded-lg shadow-sm ring-1 ring-slate-200 p-1">
            <a href="{{ route('admin.orders.index') }}" class="px-3 py-1.5 text-xs font-medium rounded-md {{ !request('status') ? 'bg-slate-100 text-slate-900' : 'text-slate-600 hover:text-slate-900' }}">All</a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-3 py-1.5 text-xs font-medium rounded-md {{ request('status') == 'pending' ? 'bg-yellow-50 text-yellow-800' : 'text-slate-600 hover:text-slate-900' }}">Pending</a>
            <a href="{{ route('admin.orders.index', ['status' => 'confirmed']) }}" class="px-3 py-1.5 text-xs font-medium rounded-md {{ request('status') == 'confirmed' ? 'bg-blue-50 text-blue-800' : 'text-slate-600 hover:text-slate-900' }}">Confirmed</a>
            <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" class="px-3 py-1.5 text-xs font-medium rounded-md {{ request('status') == 'shipped' ? 'bg-green-50 text-green-800' : 'text-slate-600 hover:text-slate-900' }}">Shipped</a>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($orders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-slate-900">#{{ $order->id }}</div>
                        <div class="text-xs text-slate-500">{{ $order->created_at->format('M d, Y h:i A') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-slate-900">{{ $order->name }}</div>
                        <div class="text-xs text-slate-500">{{ $order->phone }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-slate-900">{{ $order->city }}</div>
                        <div class="text-xs text-slate-500 truncate max-w-[200px]">{{ $order->address }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-slate-900">Rs. {{ number_format($order->total_price, 0) }}</div>
                        <div class="text-xs text-slate-500">Qty: {{ $order->quantity }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="text-xs font-medium rounded-full px-2.5 py-1 focus:ring-2 focus:ring-green-500 border-0 ring-1 ring-inset
                                {{ $order->status == 'pending' ? 'bg-yellow-50 text-yellow-800 ring-yellow-600/20' : '' }}
                                {{ $order->status == 'confirmed' ? 'bg-blue-50 text-blue-800 ring-blue-600/20' : '' }}
                                {{ $order->status == 'shipped' ? 'bg-green-50 text-green-800 ring-green-600/20' : '' }}
                                {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-800 ring-red-600/20' : '' }}">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 transition">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                        No orders found matching your criteria.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="px-6 py-4 border-t border-slate-200">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection

<x-admin-layout>
    <div class="py-10 max-w-4xl mx-auto bg-white/5 backdrop-blur-xl shadow-xl border border-white/10 rounded-2xl p-6">
        <h1 class="text-3xl font-bold text-purple-300 mb-6">🛒 Order #{{ $order->id }}</h1>

        <div class="mb-4">
            <p><strong>Customer:</strong> {{ $order->customer_name }}</p>
            <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Address:</strong> {{ $order->address }}, {{ $order->district }}</p>
            <p><strong>Delivery Date:</strong> {{ $order->delivery_date ?? 'N/A' }}</p>
                        <p><strong>Delivery Time:</strong> {{ $order->delivery_time ?? 'N/A' }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold text-purple-300 mb-2">Items</h2>
            <ul class="list-disc ml-5 text-gray-300">
                @foreach ($order->items as $item)
                    <li>
                        {{ $item->menu->name }} x {{ $item->quantity }} - ${{ number_format($item->price * $item->quantity, 2) }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mb-4">
            <p class="font-bold text-yellow-400 text-lg">
                Total: ${{ number_format($order->total_price, 2) }}
            </p>
            <p>Status: {{ ucfirst($order->status) }}</p>
        </div>

        <div class="mt-6">
            <button onclick="window.print()" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg">
                Print Order
            </button>
        </div>
    </div>
</x-admin-layout>


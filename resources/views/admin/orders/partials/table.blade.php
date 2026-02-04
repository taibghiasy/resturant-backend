<table class="w-full text-gray-300">
    <thead class="text-xs uppercase tracking-wide text-purple-300 border-b border-white/10">
        <tr>
            <th class="py-3 px-4 text-left">Order ID</th>
            <th class="py-3 px-4 text-left">Customer</th>
            <th class="py-3 px-4 text-left">Contact</th>
            <th class="py-3 px-4 text-left">Delivery Info</th>
            <th class="py-3 px-4 text-left">Items</th>
            <th class="py-3 px-4 text-left">Total</th>
            <th class="py-3 px-4 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($orders as $order)
        <tr class="border-b border-white/5 hover:bg-white/10 transition">
            <td class="py-4 px-4 font-medium">{{ $order->id }}</td>
            <td class="py-4 px-4">{{ $order->customer_name }}</td>
            <td class="py-4 px-4">
                <p>Phone: {{ $order->customer_phone }}</p>
                <p>Email: {{ $order->customer_email }}</p>
            </td>
            <td class="py-4 px-4">
                <p>Address: {{ $order->address }}</p>
                <p>District: {{ $order->district }}</p>
                <p>Delivery Date: {{ $order->delivery_date }}</p>
                <p>Delivery Time: {{ $order->delivery_time }}</p>
            </td>
            <td class="py-4 px-4">
                <ul class="list-disc ml-5 text-gray-300">
                    @foreach ($order->items as $item)
                        <li>{{ $item->menu->name }} x {{ $item->quantity }} - ${{ $item->price }}</li>
                    @endforeach
                </ul>
            </td>
            <td class="py-4 px-4 font-bold text-yellow-400">${{ $order->total_price }}</td>
            <td class="py-4 px-4 flex space-x-2">
                @if($status === 'pending')
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="delivered">
                    <button class="px-3 py-1 bg-green-600 hover:bg-green-700 rounded-xl text-white text-sm">Delivered</button>
                </form>
                @elseif($status === 'delivered')
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="completed">
                    <button class="px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded-xl text-white text-sm">Completed</button>
                </form>
                @endif

                {{-- Delete Button --}}
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded-xl text-white text-sm">Delete</button>
                </form>

                {{-- Print PDF --}}
                <a href="{{ route('admin.orders.print', $order->id) }}" target="_blank" class="px-3 py-1 bg-purple-600 hover:bg-purple-700 rounded-xl text-white text-sm">Print</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center text-gray-400 py-4">No orders.</td>
        </tr>
        @endforelse
    </tbody>
</table>

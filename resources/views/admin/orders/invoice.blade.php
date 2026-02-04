<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .details, .items { width: 100%; margin-bottom: 20px; }
        .items th, .items td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .items th { background: #f0f0f0; }
        .total { text-align: right; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Order Invoice</h2>
        <p>Order ID: {{ $order->id }}</p>
        <p>Date: {{ $order->created_at->format('d-m-Y H:i') }}</p>
    </div>

    <div class="details">
        <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
        <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
        <p><strong>Address:</strong> {{ $order->address }}, {{ $order->district }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Menu Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->menu->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total: ${{ number_format($order->total_price, 2) }}</p>
</body>
</html>

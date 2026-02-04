<!DOCTYPE html>
<html>
<head>
    <title>All Orders</title>
    <style>
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:8px; text-align:left; }
        th { background:#eee; }
    </style>
</head>
<body>
    <h2>All Orders Report</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Items</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>${{ $order->total_price }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    @foreach ($order->items as $item)
                        {{ $item->menu->name }} (x{{ $item->quantity }}) <br>
                    @endforeach
                </td>
                <td>{{ $order->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; // You need an Order model
use App\Models\OrderItem; // You need OrderItem model

class OrderApiController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'district' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'delivery_date' => 'nullable|date',
            'delivery_time' => 'nullable',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|integer|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric',
        ]);

        $order = Order::create([
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'district' => $data['district'] ?? null,
            'address' => $data['address'] ?? null,
            'delivery_date' => $data['delivery_date'] ?? null,
            'delivery_time' => $data['delivery_time'] ?? null,
        ]);

        foreach ($data['items'] as $item) {
            $order->items()->create([
                'menu_id' => $item['menu_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return response()->json(['message' => 'Order placed successfully', 'order' => $order], 201);
    }
}

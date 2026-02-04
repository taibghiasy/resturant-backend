<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\Notification;

class OrderController extends Controller
{
    /**
     * Display a listing of orders (admin panel)
     */
   public function index()
{
    $pendingOrders   = Order::with('items.menu')
                            ->where('status', 'pending')
                            ->latest()
                            ->paginate(10); // pagination

    $deliveredOrders = Order::with('items.menu')
                            ->where('status', 'delivered')
                            ->latest()
                            ->paginate(10);

    $completedOrders = Order::with('items.menu')
                            ->where('status', 'completed')
                            ->latest()
                            ->paginate(10);

    return view('admin.orders.index', compact('pendingOrders', 'deliveredOrders', 'completedOrders'));
}


    /**
     * Show a single order (admin panel)
     */
    public function show(Order $order)
    {
        $order->load('items.menu');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the order status (admin panel)
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,on_the_way,delivered,completed',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated!');
    }

    /**
     * Delete an order (admin panel)
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Order deleted!');
    }

    /**
     * Store a new order from React frontend
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'district' => 'nullable|string|max:255',
            'delivery_date' => 'nullable|date',
            'delivery_time' => 'nullable',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Create order
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'address' => $request->address,
            'district' => $request->district,
            'delivery_date' => $request->delivery_date,
            'delivery_time' => $request->delivery_time,
            'status' => 'pending',
            'total_price' => collect($request->items)->sum(fn($item) => $item['price'] * $item['quantity']),
             'is_seen' => false,
        ]);

        foreach ($request->items as $item) {
    $order->items()->create([
        'menu_id' => $item['menu_id'],
        'quantity' => $item['quantity'],
        'price' => $item['price'],
        'name' => $item['name'] ?? null, // <-- store name
    ]);
}

        

        return response()->json([
            'message' => 'Order placed successfully',
            'order' => $order->load('items'),
            'order_id' => $order->id
        ]);

        
        
    }

  // in OrderController
public function unseenCount()
{
    $count = Order::where('is_seen', false)->count();
    return response()->json(['count' => $count]);
}
public function markAllSeen()
{
    Order::where('is_seen', false)->update(['is_seen' => true]);
    return response()->json(['message' => 'All orders marked as seen']);
}


public function print(Order $order)
{
    $order->load('items.menu'); // Make sure items & menu are loaded
    $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));
    return $pdf->download('order_'.$order->id.'.pdf');
}

public function printAll()
{
    $orders = Order::with('items.menu')->get(); // all orders

    $pdf = Pdf::loadView('admin.orders.print_all', compact('orders'));

    return $pdf->download('all_orders.pdf');
}
public function clearAll()
{
    Order::query()->delete();         // deletes all orders
    \DB::table('order_items')->delete();  // deletes all items

    return back()->with('success', 'All orders cleared successfully.');
}

// Print all pending orders
public function printPending()
{
    $orders = Order::with('items.menu')->where('status', 'pending')->get();
    $pdf = Pdf::loadView('admin.orders.print_all', compact('orders'));
    return $pdf->download('pending_orders.pdf');
}

// Print all delivered orders
public function printDelivered()
{
    $orders = Order::with('items.menu')->where('status', 'delivered')->get();
    $pdf = Pdf::loadView('admin.orders.print_all', compact('orders'));
    return $pdf->download('delivered_orders.pdf');
}

// Print all completed orders
public function printCompleted()
{
    $orders = Order::with('items.menu')->where('status', 'completed')->get();
    $pdf = Pdf::loadView('admin.orders.print_all', compact('orders'));
    return $pdf->download('completed_orders.pdf');
}
// Delivered Orders page
public function delivered()
{
    $orders = Order::with('items.menu')->where('status', 'delivered')->latest()->paginate(10);
    return view('admin.orders.delivered', compact('orders'));
}

// Completed Orders page
public function completed()
{
    $orders = Order::with('items.menu')->where('status', 'completed')->latest()->paginate(10);
    return view('admin.orders.completed', compact('orders'));
}
// Clear only Pending Orders
public function clearPending()
{
    $pendingOrders = Order::where('status', 'pending')->get();
    foreach ($pendingOrders as $order) {
        $order->items()->delete(); // Delete related items
        $order->delete();
    }

    return redirect()->back()->with('success', 'All pending orders cleared successfully.');
}

// Clear only Delivered Orders
public function clearDelivered()
{
    $deliveredOrders = Order::where('status', 'delivered')->get();
    foreach ($deliveredOrders as $order) {
        $order->items()->delete();
        $order->delete();
    }

    return redirect()->back()->with('success', 'All delivered orders cleared successfully.');
}

// Clear only Completed Orders
public function clearCompleted()
{
    $completedOrders = Order::where('status', 'completed')->get();
    foreach ($completedOrders as $order) {
        $order->items()->delete();
        $order->delete();
    }

    return redirect()->back()->with('success', 'All completed orders cleared successfully.');
}


}

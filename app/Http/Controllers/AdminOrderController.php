<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of all orders.
     */
    public function index()
    {
        $orders = Order::with(['user', 'orderStatus', 'paymentMethod', 'shippingMethod'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $orderStatuses = OrderStatus::all();

        return view('admin.orders.index', compact('orders', 'orderStatuses'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['orderDetails.variant.product', 'user', 'addressBook', 'paymentMethod', 'shippingMethod', 'orderStatus']);
        $orderStatuses = OrderStatus::all();

        return view('admin.orders.show', compact('order', 'orderStatuses'));
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        
        $request->validate([
            'status_id' => 'required|exists:orderStatus,orderStatus_id',
        ]);

        $order->update([
            'order_status_id' => $request->status_id,
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}

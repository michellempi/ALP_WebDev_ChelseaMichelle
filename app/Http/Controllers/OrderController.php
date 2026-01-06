<?php

namespace App\Http\Controllers;

use App\Models\AddressBook;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['orderStatus', 'paymentMethod', 'shippingMethod', 'addressBook'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('users.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cart = Cart::where('user_id', auth()->id())->with('cartItems.variant.product')->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('carts.index')->with('error', 'Your cart is empty.');
        }

        $addresses = AddressBook::where('user_id', auth()->id())->get();
        $paymentMethods = PaymentMethod::all();
        $shippingMethods = ShippingMethod::all();

        return view('users.orders.create', compact('cart', 'addresses', 'paymentMethods', 'shippingMethods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'address_book_id' => 'required|exists:addressBooks,address_id',
            'payment_method_id' => 'required|exists:paymentMethods,payment_method_id',
            'shipping_method_id' => 'required|exists:shippingMethods,shipping_method_id',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verify cart exists and has items
        $cart = Cart::where('user_id', auth()->id())->with('cartItems.variant.product')->first();
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('carts.index')->with('error', 'Your cart is empty.');
        }

        // Check stock availability
        foreach ($cart->cartItems as $cartItem) {
            if ($cartItem->variant->stock_quantity < $cartItem->quantity) {
                return redirect()->route('carts.index')->with('error', 'Insufficient stock for ' . $cartItem->variant->variant_name . '. Available: ' . $cartItem->variant->stock_quantity);
            }
        }

        // Handle payment proof upload
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment-proofs', 'public');
        }

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'address_book_id' => $request->address_book_id,
            'payment_method_id' => $request->payment_method_id,
            'shipping_method_id' => $request->shipping_method_id,
            'order_status_id' => 1, // Pending status
            'promo_id' => null, // TODO: Apply promo if applicable
            'order_date' => now()->toDateString(),
            'order_time' => now()->toTimeString(),
            'total_amount' => $cart->total_amount,
            'payment_proof' => $paymentProofPath,
        ]);

        // Create order details from cart items and decrease stock
        foreach ($cart->cartItems as $cartItem) {
            OrderDetail::create([
                'order_id' => $order->order_id,
                'variant_id' => $cartItem->variant_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
            ]);

            // Decrease stock
            $variant = Variant::find($cartItem->variant_id);
            if ($variant) {
                $variant->decrement('stock_quantity', $cartItem->quantity);
            }
        }

        // Clear the cart
        $cart->cartItems()->delete();
        $cart->delete();

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully! Please wait for confirmation.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['orderDetails.variant.product', 'addressBook', 'paymentMethod', 'shippingMethod', 'orderStatus']);

        return view('users.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        // Users cannot edit orders, only upload payment proof if needed
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Users cannot update orders directly
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // Users cannot delete orders
        abort(403);
    }
}

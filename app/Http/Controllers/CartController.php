<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Variant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->with('cartItems.variant.product')->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'total_amount' => 0,
            ]);
        }

        return view('users.carts.index', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:variants,variants_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $variant = Variant::findOrFail($request->variant_id);

        // Get or create cart for user
        $cart = Cart::firstOrCreate(
            ['user_id' => auth()->id()],
            ['total_amount' => 0]
        );

        // Calculate discounted price
        $activePromos = \App\Models\Promo::active()->get();
        $discountedPrice = $variant->price;

        foreach ($activePromos as $promo) {
            $discountAmount = $variant->price * ($promo->discount / 100);
            $newPrice = $variant->price - $discountAmount;
            if ($newPrice < $discountedPrice) {
                $discountedPrice = $newPrice;
            }
        }

        // Check if item already exists in cart
        $existingItem = CartItem::where('cart_id', $cart->cart_id)
            ->where('variant_id', $request->variant_id)
            ->first();

        if ($existingItem) {
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity,
                'price' => $discountedPrice,
            ]);
        }

        // Recalculate total
        $cart->calculateTotal();

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cart = Cart::where('cart_id', $id)->where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'cart_item_id' => 'required|exists:cartItems,cart_item_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('cart_item_id', $request->cart_item_id)
            ->where('cart_id', $cart->cart_id)
            ->firstOrFail();

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        // Recalculate total
        $cart->calculateTotal();

        return redirect()->route('carts.index')->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $cart = Cart::where('cart_id', $id)->where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'cart_item_id' => 'required|exists:cartItems,cart_item_id',
        ]);

        $cartItem = CartItem::where('cart_item_id', $request->cart_item_id)
            ->where('cart_id', $cart->cart_id)
            ->firstOrFail();

        $cartItem->delete();

        // Recalculate total
        $cart->calculateTotal();

        return redirect()->route('carts.index')->with('success', 'Item removed from cart successfully!');
    }
}

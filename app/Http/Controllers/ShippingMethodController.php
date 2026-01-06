<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippingMethods = ShippingMethod::all();
        return view('admin.shipping-methods.index', compact('shippingMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:shippingMethods,name',
        ]);

        ShippingMethod::create($request->all());

        return redirect()->route('admin.shipping-methods.index')->with('success', 'Shipping method created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingMethod $shippingMethod)
    {
        return view('admin.shipping-methods.show', compact('shippingMethod'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingMethod $shippingMethod)
    {
        return view('admin.shipping-methods.edit', compact('shippingMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShippingMethod $shippingMethod)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:shippingMethods,name,' . $shippingMethod->shipping_method_id . ',shipping_method_id',
        ]);

        $shippingMethod->update($request->all());

        return redirect()->route('admin.shipping-methods.index')->with('success', 'Shipping method updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingMethod $shippingMethod)
    {
        // Check if shipping method is being used by any orders
        if ($shippingMethod->orders()->exists()) {
            return redirect()->route('admin.shipping-methods.index')->with('error', 'Cannot delete shipping method because it is being used by existing orders.');
        }

        $shippingMethod->delete();

        return redirect()->route('admin.shipping-methods.index')->with('success', 'Shipping method deleted successfully.');
    }
}

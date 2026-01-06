<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return view('admin.payment-methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payment-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:paymentMethods,name',
        ]);

        PaymentMethod::create($request->all());

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.show', compact('paymentMethod'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:paymentMethods,name,' . $paymentMethod->payment_method_id . ',payment_method_id',
        ]);

        $paymentMethod->update($request->all());

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        // Check if payment method is being used by any orders
        if ($paymentMethod->orders()->exists()) {
            return redirect()->route('admin.payment-methods.index')->with('error', 'Cannot delete payment method because it is being used by existing orders.');
        }

        $paymentMethod->delete();

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method deleted successfully.');
    }
}

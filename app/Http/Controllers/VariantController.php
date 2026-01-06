<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variants = Variant::with('product')->get();
        return view('admin.variants.index', compact('variants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.variants.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'variant_name' => 'required|string|max:255',
            'stock_quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'product_id' => 'required|exists:products,product_id',
        ]);

        Variant::create($request->all());

        return redirect()->route('admin.variants.index')->with('success', 'Variant created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Variant $variant)
    {
        return view('admin.variants.show', compact('variant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Variant $variant)
    {
        $products = Product::all();
        return view('admin.variants.edit', compact('variant', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variant $variant)
    {
        $request->validate([
            'variant_name' => 'required|string|max:255',
            'stock_quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'product_id' => 'required|exists:products,product_id',
        ]);

        $variant->update($request->all());

        return redirect()->route('admin.variants.index')->with('success', 'Variant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variant $variant)
    {
        $variant->delete();

        return redirect()->route('admin.variants.index')->with('success', 'Variant deleted successfully.');
    }
}

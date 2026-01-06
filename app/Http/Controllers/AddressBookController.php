<?php

namespace App\Http\Controllers;

use App\Models\AddressBook;
use Illuminate\Http\Request;

class AddressBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = AddressBook::where('user_id', auth()->id())
            ->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('users.address-books.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.address-books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'is_default' => 'boolean',
        ]);

        // If this is set as default, remove default from other addresses
        if ($request->is_default) {
            AddressBook::where('user_id', auth()->id())->update(['is_default' => false]);
        }

        AddressBook::create([
            'user_id' => auth()->id(),
            'receiver_name' => $request->receiver_name,
            'phone' => $request->phone,
            'address_line' => $request->address_line,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'is_default' => $request->is_default ?? false,
        ]);

        return redirect()->route('address-books.index')->with('success', 'Address added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AddressBook $addressBook)
    {
        // Ensure user can only view their own addresses
        if ($addressBook->user_id !== auth()->id()) {
            abort(403);
        }

        return view('users.address-books.show', compact('addressBook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AddressBook $addressBook)
    {
        // Ensure user can only edit their own addresses
        if ($addressBook->user_id !== auth()->id()) {
            abort(403);
        }

        return view('users.address-books.edit', compact('addressBook'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AddressBook $addressBook)
    {
        // Ensure user can only update their own addresses
        if ($addressBook->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'is_default' => 'boolean',
        ]);

        // If this is set as default, remove default from other addresses
        if ($request->is_default) {
            AddressBook::where('user_id', auth()->id())
                ->where('address_id', '!=', $addressBook->address_id)
                ->update(['is_default' => false]);
        }

        $addressBook->update([
            'receiver_name' => $request->receiver_name,
            'phone' => $request->phone,
            'address_line' => $request->address_line,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'is_default' => $request->is_default ?? false,
        ]);

        return redirect()->route('address-books.index')->with('success', 'Address updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AddressBook $addressBook)
    {
        // Ensure user can only delete their own addresses
        if ($addressBook->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if address is being used by any orders
        if ($addressBook->orders()->exists()) {
            return redirect()->route('address-books.index')->with('error', 'Cannot delete address because it is being used by existing orders.');
        }

        $addressBook->delete();

        return redirect()->route('address-books.index')->with('success', 'Address deleted successfully!');
    }
}

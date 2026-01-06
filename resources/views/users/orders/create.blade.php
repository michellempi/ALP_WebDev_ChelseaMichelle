<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Cart Summary -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Order Summary</h3>
                        <div class="space-y-4">
                            @foreach($cart->cartItems as $item)
                                <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                    @if($item->variant->product->image_url)
                                        <img src="{{ asset('storage/' . $item->variant->product->image_url) }}" alt="{{ $item->variant->product->name }}" class="w-16 h-16 object-cover rounded">
                                    @endif
                                    <div class="flex-1">
                                        <h4 class="font-medium">{{ $item->variant->product->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $item->variant->variant_name }}</p>
                                        <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">${{ number_format($item->subtotal, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 pt-4 border-t">
                            <div class="flex justify-between font-medium">
                                <span>Total:</span>
                                <span>${{ number_format($cart->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Shipping Address</h3>
                        @error('address_book_id')
                            <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                        @enderror
                        <div class="space-y-4">
                            @forelse($addresses as $address)
                                <label class="flex items-start space-x-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="address_book_id" value="{{ $address->address_id }}" class="mt-1" {{ $loop->first ? 'checked' : '' }}>
                                    <div>
                                        <p class="font-medium">{{ $address->receiver_name }}</p>
                                        <p class="text-sm text-gray-600">{{ $address->phone }}</p>
                                        <p class="text-sm text-gray-600">{{ $address->full_address }}</p>
                                    </div>
                                </label>
                            @empty
                                <p class="text-gray-500">No addresses found. <a href="{{ route('address-books.create') }}" class="text-blue-600 hover:text-blue-800">Add an address</a></p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Payment Method</h3>
                        @error('payment_method_id')
                            <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                        @enderror
                        <div class="space-y-4">
                            @foreach($paymentMethods as $method)
                                <label class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method_id" value="{{ $method->payment_method_id }}" class="mt-1" {{ $loop->first ? 'checked' : '' }}>
                                    <div>
                                        <p class="font-medium">{{ $method->name }}</p>
                                        @if($method->description)
                                            <p class="text-sm text-gray-600">{{ $method->description }}</p>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Shipping Method -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Shipping Method</h3>
                        @error('shipping_method_id')
                            <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                        @enderror
                        <div class="space-y-4">
                            @foreach($shippingMethods as $method)
                                <label class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="shipping_method_id" value="{{ $method->shipping_method_id }}" class="mt-1" {{ $loop->first ? 'checked' : '' }}>
                                    <div>
                                        <p class="font-medium">{{ $method->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $method->description }}</p>
                                        <p class="text-sm font-medium">Cost: ${{ number_format($method->cost ?? 0, 2) }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Payment Proof Upload -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Payment Proof</h3>
                        @error('payment_proof')
                            <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-2">Upload Payment Proof (Image)</label>
                            <input type="file" name="payment_proof" id="payment_proof" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-sm text-gray-500 mt-1">Please upload a proof of payment (receipt, screenshot, etc.)</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <a href="{{ route('carts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-4">
                        Back to Cart
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Place Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
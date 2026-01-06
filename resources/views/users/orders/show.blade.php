<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }} #{{ $order->order_id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Order Status -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium">Order Status</h3>
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $order->status_badge_classes }}">
                                {{ $order->orderStatus->name }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">Ordered on {{ $order->formatted_order_date_time }}</p>
                    </div>

                    <!-- Order Items -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-4">Order Items</h3>
                        <div class="space-y-4">
                            @foreach($order->orderDetails as $detail)
                                <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                    @if($detail->variant->product->image_url)
                                        <img src="{{ asset('storage/' . $detail->variant->product->image_url) }}" alt="{{ $detail->variant->product->name }}" class="w-16 h-16 object-cover rounded">
                                    @endif
                                    <div class="flex-1">
                                        <h4 class="font-medium">{{ $detail->variant->product->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $detail->variant->variant_name }}</p>
                                        <p class="text-sm text-gray-600">Quantity: {{ $detail->quantity }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">${{ number_format($detail->price, 2) }}</p>
                                        <p class="text-sm text-gray-600">Subtotal: ${{ number_format($detail->subtotal, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-4">Order Summary</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span>Subtotal:</span>
                                    <span>${{ number_format($order->total_amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Shipping ({{ $order->shippingMethod->name }}):</span>
                                    <span>${{ number_format($order->shippingMethod->cost ?? 0, 2) }}</span>
                                </div>
                                <div class="border-t pt-2 flex justify-between font-medium">
                                    <span>Total:</span>
                                    <span>${{ number_format($order->total_amount + ($order->shippingMethod->cost ?? 0), 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping & Payment Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Shipping Address -->
                        <div>
                            <h3 class="text-lg font-medium mb-4">Shipping Address</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="font-medium">{{ $order->addressBook->receiver_name }}</p>
                                <p>{{ $order->addressBook->phone }}</p>
                                <p>{{ $order->addressBook->full_address }}</p>
                            </div>
                        </div>

                        <!-- Payment Info -->
                        <div>
                            <h3 class="text-lg font-medium mb-4">Payment Information</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p><strong>Method:</strong> {{ $order->paymentMethod->name }}</p>
                                @if($order->payment_proof)
                                    <p><strong>Payment Proof:</strong></p>
                                    <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Payment Proof" class="w-full max-w-xs mt-2 rounded border">
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="flex justify-start">
                        <a href="{{ route('orders.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shipping Method Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">{{ $shippingMethod->name }}</h3>

                    <p><strong>ID:</strong> {{ $shippingMethod->shipping_method_id }}</p>
                    <p><strong>Name:</strong> {{ $shippingMethod->name }}</p>
                    <p><strong>Description:</strong> {{ $shippingMethod->description ?? 'N/A' }}</p>
                    <p><strong>Cost:</strong> ${{ number_format($shippingMethod->cost, 2) }}</p>
                    <p><strong>Created At:</strong> {{ $shippingMethod->created_at->format('Y-m-d H:i:s') }}</p>
                    <p><strong>Updated At:</strong> {{ $shippingMethod->updated_at->format('Y-m-d H:i:s') }}</p>

                    <div class="mt-6">
                        <a href="{{ route('admin.shipping-methods.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Back to Shipping Methods
                        </a>
                        <a href="{{ route('admin.shipping-methods.edit', $shippingMethod) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
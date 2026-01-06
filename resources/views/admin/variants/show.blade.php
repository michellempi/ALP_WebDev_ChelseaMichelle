<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Variant Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">{{ $variant->variant_name }}</h3>

                    <p><strong>ID:</strong> {{ $variant->variants_id }}</p>
                    <p><strong>Variant Name:</strong> {{ $variant->variant_name }}</p>
                    <p><strong>Product:</strong> {{ $variant->product->name }}</p>
                    <p><strong>Stock Quantity:</strong> {{ $variant->stock_quantity }}</p>
                    <p><strong>Price:</strong> ${{ number_format($variant->price, 2) }}</p>
                    <p><strong>Created At:</strong> {{ $variant->created_at->format('Y-m-d H:i:s') }}</p>
                    <p><strong>Updated At:</strong> {{ $variant->updated_at->format('Y-m-d H:i:s') }}</p>

                    <div class="mt-6">
                        <a href="{{ route('admin.variants.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Back to Variants
                        </a>
                        <a href="{{ route('admin.variants.edit', $variant) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
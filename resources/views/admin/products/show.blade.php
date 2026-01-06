<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">{{ $product->name }}</h3>

                    <p><strong>ID:</strong> {{ $product->product_id }}</p>
                    <p><strong>Name:</strong> {{ $product->name }}</p>
                    <p><strong>Category:</strong> {{ $product->category->name }}</p>
                    <p><strong>Stock Quantity:</strong> {{ $product->stock_quantity }}</p>
                    <p><strong>Image:</strong> {{ $product->image_url ?: 'No image' }}</p>
                    @if($product->image_url)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover">
                        </div>
                    @endif
                    <p><strong>Created At:</strong> {{ $product->created_at->format('Y-m-d H:i:s') }}</p>
                    <p><strong>Updated At:</strong> {{ $product->updated_at->format('Y-m-d H:i:s') }}</p>

                    <div class="mt-6">
                        <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Back to Products
                        </a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
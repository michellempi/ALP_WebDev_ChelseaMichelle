<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Catalogue') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($activePromos->count() > 0)
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                            <h3 class="text-lg font-semibold text-red-800 mb-2">🎉 Active Promotions!</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                @foreach($activePromos as $promo)
                                    <div class="bg-white p-3 rounded border border-red-200">
                                        <div class="font-medium text-red-800">{{ $promo->name }}</div>
                                        <div class="text-sm text-red-600">{{ $promo->discount }}% OFF</div>
                                        <div class="text-xs text-gray-500">
                                            Valid until: {{ $promo->end_time->format('M j, Y g:i A') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                                @if($product->image_url)
                                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif

                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>

                                    @if($product->variants->count() > 0)
                                        <div class="mb-3">
                                            <h4 class="text-sm font-medium text-gray-700 mb-2">Variants:</h4>
                                            <div class="space-y-2">
                                                @foreach($product->variants as $variant)
                                                    <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                                                        <span class="text-sm">{{ $variant->variant_name }}</span>
                                                        <div class="flex items-center space-x-2">
                                                            @if($variant->active_promo)
                                                                <div class="text-right">
                                                                    <div class="text-xs text-gray-500 line-through">${{ number_format($variant->original_price, 2) }}</div>
                                                                    <div class="text-sm font-bold text-red-600">${{ number_format($variant->discounted_price, 2) }}</div>
                                                                    <div class="text-xs bg-red-100 text-red-800 px-1 py-0.5 rounded">
                                                                        -{{ $variant->active_promo->discount }}%
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <span class="text-sm font-medium">${{ number_format($variant->price, 2) }}</span>
                                                            @endif
                                                            <form action="{{ route('carts.store') }}" method="POST" class="inline">
                                                                @csrf
                                                                <input type="hidden" name="variant_id" value="{{ $variant->variants_id }}">
                                                                <input type="hidden" name="quantity" value="1">
                                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-xs px-2 py-1 rounded">
                                                                    Add to Cart
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="mb-3">
                                            <span class="text-sm text-gray-500">No variants available</span>
                                        </div>
                                    @endif

                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">Category: {{ $product->category->name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($products->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500">No products available in the catalogue.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
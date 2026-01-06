<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Variant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.variants.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="variant_name" :value="__('Variant Name')" />
                            <x-text-input id="variant_name" class="block mt-1 w-full" type="text" name="variant_name" :value="old('variant_name')" required />
                            <x-input-error :messages="$errors->get('variant_name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="product_id" :value="__('Product')" />
                            <select id="product_id" name="product_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->product_id }}" {{ old('product_id') == $product->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="stock_quantity" :value="__('Stock Quantity')" />
                            <x-text-input id="stock_quantity" class="block mt-1 w-full" type="number" name="stock_quantity" :value="old('stock_quantity')" required min="0" />
                            <x-input-error :messages="$errors->get('stock_quantity')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required min="0" step="0.01" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4" href="{{ route('admin.variants.index') }}">
                                {{ __('Cancel') }}
                            </a>

                            <x-primary-button>
                                {{ __('Create Variant') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
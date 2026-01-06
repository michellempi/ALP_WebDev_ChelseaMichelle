<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Variants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.variants.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Create New Variant
                    </a>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Variant Name</th>
                                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Product</th>
                                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Stock</th>
                                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Price</th>
                                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Created At</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach($variants as $variant)
                                <tr>
                                    <td class="w-1/6 text-left py-3 px-4">{{ $variant->variant_name }}</td>
                                    <td class="w-1/6 text-left py-3 px-4">{{ $variant->product->name }}</td>
                                    <td class="w-1/6 text-left py-3 px-4">{{ $variant->stock_quantity }}</td>
                                    <td class="w-1/6 text-left py-3 px-4">${{ number_format($variant->price, 2) }}</td>
                                    <td class="w-1/6 text-left py-3 px-4">{{ $variant->created_at->format('Y-m-d') }}</td>
                                    <td class="text-left py-3 px-4">
                                        <a href="{{ route('admin.variants.show', $variant) }}" class="text-blue-500 hover:text-blue-700 mr-2">View</a>
                                        <a href="{{ route('admin.variants.edit', $variant) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">Edit</a>
                                        <form action="{{ route('admin.variants.destroy', $variant) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
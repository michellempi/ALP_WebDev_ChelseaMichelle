<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Addresses') }}
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

                    <div class="flex justify-between items-center mb-6">
                        <p class="text-gray-600">Manage your delivery addresses</p>
                        <a href="{{ route('address-books.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New Address
                        </a>
                    </div>

                    @if($addresses->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($addresses as $address)
                                <div class="border border-gray-200 rounded-lg p-4 {{ $address->is_default ? 'border-blue-500 bg-blue-50' : '' }}">
                                    @if($address->is_default)
                                        <div class="flex justify-between items-start mb-2">
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Default Address</span>
                                        </div>
                                    @endif

                                    <div class="space-y-2">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="font-semibold text-gray-900">{{ $address->receiver_name }}</h3>
                                                <p class="text-sm text-gray-600">{{ $address->phone }}</p>
                                            </div>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('address-books.edit', $address) }}" class="text-blue-600 hover:text-blue-800 text-sm">Edit</a>
                                                @if(!$address->is_default)
                                                    <form action="{{ route('address-books.destroy', $address) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this address?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="text-sm text-gray-700">
                                            <p>{{ $address->address_line }}</p>
                                            <p>{{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}</p>
                                        </div>

                                        @if(!$address->is_default)
                                            <form action="{{ route('address-books.update', $address) }}" method="POST" class="mt-3">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="receiver_name" value="{{ $address->receiver_name }}">
                                                <input type="hidden" name="phone" value="{{ $address->phone }}">
                                                <input type="hidden" name="address_line" value="{{ $address->address_line }}">
                                                <input type="hidden" name="city" value="{{ $address->city }}">
                                                <input type="hidden" name="province" value="{{ $address->province }}">
                                                <input type="hidden" name="postal_code" value="{{ $address->postal_code }}">
                                                <input type="hidden" name="is_default" value="1">
                                                <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm underline">
                                                    Set as Default
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-gray-400 text-6xl mb-4">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No addresses found</h3>
                            <p class="text-gray-500 mb-6">Add your first delivery address to get started.</p>
                            <a href="{{ route('address-books.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add Your First Address
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
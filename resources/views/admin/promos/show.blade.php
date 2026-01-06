<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Promo Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">{{ $promo->name }}</h3>

                    <p><strong>ID:</strong> {{ $promo->promo_id }}</p>
                    <p><strong>Name:</strong> {{ $promo->name }}</p>
                    <p><strong>Start Time:</strong> {{ $promo->start_time->format('Y-m-d H:i:s') }}</p>
                    <p><strong>End Time:</strong> {{ $promo->end_time->format('Y-m-d H:i:s') }}</p>
                    <p><strong>Discount:</strong> {{ $promo->discount }}%</p>
                    <p><strong>Status:</strong>
                        @if(now()->between($promo->start_time, $promo->end_time))
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Active</span>
                        @elseif(now()->lt($promo->start_time))
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Upcoming</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded">Expired</span>
                        @endif
                    </p>
                    <p><strong>Created At:</strong> {{ $promo->created_at->format('Y-m-d H:i:s') }}</p>
                    <p><strong>Updated At:</strong> {{ $promo->updated_at->format('Y-m-d H:i:s') }}</p>

                    <div class="mt-6">
                        <a href="{{ route('admin.promos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Back to Promos
                        </a>
                        <a href="{{ route('admin.promos.edit', $promo) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Promos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.promos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Create New Promo
                    </a>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Start Time</th>
                                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">End Time</th>
                                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Discount (%)</th>
                                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach($promos as $promo)
                                <tr>
                                    <td class="w-1/6 text-left py-3 px-4">{{ $promo->name }}</td>
                                    <td class="w-1/6 text-left py-3 px-4">{{ $promo->start_time->format('Y-m-d H:i') }}</td>
                                    <td class="w-1/6 text-left py-3 px-4">{{ $promo->end_time->format('Y-m-d H:i') }}</td>
                                    <td class="w-1/6 text-left py-3 px-4">{{ $promo->discount }}%</td>
                                    <td class="w-1/6 text-left py-3 px-4">
                                        @if(now()->between($promo->start_time, $promo->end_time))
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Active</span>
                                        @elseif(now()->lt($promo->start_time))
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Upcoming</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded">Expired</span>
                                        @endif
                                    </td>
                                    <td class="text-left py-3 px-4">
                                        <a href="{{ route('admin.promos.show', $promo) }}" class="text-blue-500 hover:text-blue-700 mr-2">View</a>
                                        <a href="{{ route('admin.promos.edit', $promo) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">Edit</a>
                                        <form action="{{ route('admin.promos.destroy', $promo) }}" method="POST" class="inline">
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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Address') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('address-books.update', $addressBook) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="receiver_name" :value="__('Receiver Name')" />
                            <x-text-input id="receiver_name" class="block mt-1 w-full" type="text" name="receiver_name" :value="old('receiver_name', $addressBook->receiver_name)" required />
                            <x-input-error :messages="$errors->get('receiver_name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="phone" :value="__('Phone Number')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone', $addressBook->phone)" required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="address_line" :value="__('Address Line')" />
                            <x-text-input id="address_line" class="block mt-1 w-full" type="text" name="address_line" :value="old('address_line', $addressBook->address_line)" placeholder="Street address, building, apartment, etc." required />
                            <x-input-error :messages="$errors->get('address_line')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="city" :value="__('City')" />
                                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $addressBook->city)" required />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="province" :value="__('Province/State')" />
                                <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province', $addressBook->province)" required />
                                <x-input-error :messages="$errors->get('province')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="postal_code" :value="__('Postal Code')" />
                            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code', $addressBook->postal_code)" required />
                            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_default" value="1" {{ old('is_default', $addressBook->is_default) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-600">Set as default address</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4" href="{{ route('address-books.index') }}">
                                {{ __('Cancel') }}
                            </a>

                            <x-primary-button>
                                {{ __('Update Address') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100  text-center">
                    {{ __("Create new customers!") }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('customers.store') }}">
                        @csrf
                
                        <!-- Booking Code -->
                        {{-- <div>
                            <x-input-label for="booking_id" :value="__('Booking Code')" />
                            <x-text-input id="booking_id" class="block mt-1 w-full" type="text" name="booking_id" :value="old('booking_id')" required autofocus/>
                            <x-input-error :messages="$errors->get('booking_id')" class="mt-2" />
                        </div> --}}
                
                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Customer Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                
                        <!-- Phone Number -->
                        <div class="mt-4 flex">
                            <div>
                                <x-input-label for="country_code" :value="__('Country Code')" />
                                <x-text-input id="country_code" class="block mt-1 w-full" type="text" name="country_code" :value="'+62'" required />
                                <x-input-error :messages="$errors->get('country_code')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-input-label for="phone_number" :value="__('Phone Number')" />
                                <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required />
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4 flex">
                            <div>
                                <x-input-label for="room_number" :value="__('Room Number')" />
                                <x-text-input id="room_number" class="block mt-1 w-full" type="text" name="room_number" :value="old('room_number')" required />
                                <x-input-error :messages="$errors->get('room_number')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-input-label for="room_passcode" :value="__('Room Passcode')" />
                                <x-text-input id="room_passcode" class="block mt-1 w-full" type="text" name="room_passcode" :value="old('room_passcode')" required />
                                <x-input-error :messages="$errors->get('room_passcode')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4 flex">
                            <div class="w-full">
                                <x-input-label for="checkin_date" :value="__('Check In Date')" />
                                <x-text-input id="checkin_date" class="mt-1 block w-full" type="date" name="checkin_date" :value="old('checkin_date')" required />
                                <x-input-error :messages="$errors->get('checkin_date')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-input-label for="checkout_date" :value="__('Check In Date')" />
                                <x-text-input id="checkout_date" class="mt-1 block w-full" type="date" name="checkout_date" :value="old('checkout_date')" required />
                                <x-input-error :messages="$errors->get('checkout_date')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

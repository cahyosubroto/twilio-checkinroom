<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("List of your customers!") }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="border-collapse border border-slate-500 w-full">
                        <thead>
                          <tr>
                            <th class="border border-slate-600">Book #</th>
                            <th class="border border-slate-600">Name</th>
                            <th class="border border-slate-600">Room</th>
                            <th class="border border-slate-600">Duration</th>
                            <th class="border border-slate-600">Last Call / Checked in</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $cust)
                                <tr>
                                <td class="border border-slate-700">{{ $cust->booking_id }}</td>
                                <td class="border border-slate-700">{{ $cust->name }}</td>
                                <td class="border border-slate-700">{{ $cust->room_number }}</td>
                                <td class="border border-slate-700">{{ date('d F Y',strtotime($cust->checkin_date)) }} until {{ date('d F Y',strtotime($cust->checkout_date)) }}</td>
                                <td class="border border-slate-700">{{ $cust->created_at == $cust->updated_at ? '-' : date('d F Y -- h:i',strtotime($cust->updated_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

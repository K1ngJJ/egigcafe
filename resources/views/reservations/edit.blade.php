@extends('layouts.backend')

@section('navTheme')
{{ 'light' }}
@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}
@endsection

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</head>
<body>
<div class="min-vh-100 d-flex align-items-start mt-5 pt-5vh">
    <div class="container">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex m-2 p-2">
                    <a href="{{ route('reservations.index') }}"
                       class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Reservation List</a>
                </div>
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                        <form method="POST" action="{{ route('reservations.update', $reservation->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="sm:col-span-6">
                                <label for="first_name" class="block text-sm font-medium text-gray-700"> First Name
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="first_name" name="first_name"
                                           value="{{ $reservation->first_name }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('first_name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Last Name -->
                            <div class="sm:col-span-6">
                                <label for="last_name" class="block text-sm font-medium text-gray-700"> Last Name
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="last_name" name="last_name"
                                           value="{{ $reservation->last_name }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('last_name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Email -->
                            <div class="sm:col-span-6">
                                <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                                <div class="mt-1">
                                    <input type="email" id="email" name="email" value="{{ $reservation->email }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('email')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Phone Number -->
                            <div class="sm:col-span-6">
                                <label for="tel_number" class="block text-sm font-medium text-gray-700"> Phone number
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="tel_number" name="tel_number"
                                           value="{{ $reservation->tel_number }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('tel_number')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Reservation Date -->
                            <div class="sm:col-span-6">
                                <label for="res_date" class="block text-sm font-medium text-gray-700">Reservation Date</label>
                                <div class="mt-1">
                                    <input type="datetime-local" id="res_date" name="res_date"
                                           value="{{ $reservation->res_date ? \Carbon\Carbon::parse($reservation->res_date)->format('Y-m-d\TH:i') : '' }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('res_date')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Guest Number -->
                            <div class="sm:col-span-6">
                                <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number
                                </label>
                                <div class="mt-1">
                                    <input type="number" id="guest_number" name="guest_number"
                                           value="{{ $reservation->guest_number }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('guest_number')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Service Selection -->
                            <div class="sm:col-span-6">
                                <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
                                <div class="mt-1">
                                    <select id="service_id" name="service_id" class="form-multiselect block w-full mt-1">
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}"
                                                    {{ $service->id == $reservation->service_id ? 'selected' : '' }}>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('service_id')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Package Selection -->
                            <div class="sm:col-span-6 pt-5">
                                <label for="package_id" class="block text-sm font-medium text-gray-700">Package</label>
                                <div class="mt-1">
                                    <select id="package_id" name="package_id" class="form-multiselect block w-full mt-1">
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}"
                                                    {{ $package->id == $reservation->package_id ? 'selected' : '' }}>
                                                {{ $package->name }} ({{ $package->guest_number }} Guests)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('package_id')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                           <!-- Supply Choice -->
                            <div class="sm:col-span-6">
                                <br>
                                <label for="supply_choice" class="block text-sm font-medium text-gray-700">Supply Choice</label>
                                <div class="mt-1 flex flex-row">
                                    <input type="radio" id="bring_own" name="supply_choice" value="bring_own" {{ $reservation->supply_choice === 'bring_own' ? 'checked' : '' }} class="mr-2">
                                    <label for="bring_own">Bring Own Supplies</label>
                                    <input type="radio" id="borrow_supplies" name="supply_choice" value="borrow_supplies" {{ $reservation->supply_choice === 'borrow_supplies' ? 'checked' : '' }} class="ml-4 mr-2">
                                    <label for="borrow_supplies">Borrow Our Supplies</label>
                                </div>
                            </div>
                            <br>
                            <!-- Inventory Supplies -->
                            <div id="inventoryFields" style="{{ $reservation->supply_choice === 'borrow_supplies' ? 'display: block;' : 'display: none;' }}">
                                <div class="sm:col-span-6">
                                    <label for="inventory_supplies" class="block text-sm font-medium text-gray-700">Inventory Supplies</label>
                                    @foreach ($inventories as $inventory)
                                        <div class="flex items-center mb-2">
                                        <input type="checkbox" id="inventory_{{ $inventory->id }}" name="inventory_supplies[]" value="{{ $inventory->id }}" {{ is_array($reservation->inventory_supplies) && in_array($inventory->id, $reservation->inventory_supplies) ? 'checked' : '' }} class="mr-2">
                                            <label for="inventory_{{ $inventory->id }}"> {{ $inventory->name }}</label>
                                            <input type="number" id="quantity_{{ $inventory->id }}" name="inventory_quantities[]" value="{{ is_object($reservation->inventory_supplies) ? $reservation->inventory_supplies->where('id', $inventory->id)->first()->pivot->quantity ?? 1 : 1 }}" class="ml-4 w-8 border border-gray-400 rounded-md py-1 px-2">

                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="sm:col-span-6 pt-5">
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <div class="mt-1">
                                    <select id="status" name="status" class="form-multiselect block w-full mt-1">
                                        @foreach (\App\Enums\ReservationStatus::cases() as $status)
                                            <option value="{{ $status->value }}" {{ $status->value === $reservation->status ? 'selected' : '' }}>
                                                {{ $status->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('status')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Submit Button -->
                            <div class="mt-6 p-4">
                                <button type="submit"
                                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bringOwnRadio = document.getElementById('bring_own');
        const borrowSuppliesRadio = document.getElementById('borrow_supplies');
        const inventoryFields = document.getElementById('inventoryFields');

        function toggleInventoryFields() {
            inventoryFields.style.display = borrowSuppliesRadio.checked ? 'block' : 'none';
        }

        toggleInventoryFields();

        bringOwnRadio.addEventListener('change', function () {
            toggleInventoryFields();
        });

        borrowSuppliesRadio.addEventListener('change', function () {
            toggleInventoryFields();
        });

        // Get the supply choice value from the database
        const supplyChoice = "{{ $reservation->supply_choice }}";

        // Set the appropriate radio button based on the database value
        if (supplyChoice === 'bring_own') {
            bringOwnRadio.checked = true;
        } else {
            borrowSuppliesRadio.checked = true;
        }

        // If the supply choice is to borrow supplies, populate the inventory supplies and quantities
        if (supplyChoice === 'borrow_supplies') {
            const inventorySupplies = {!! json_encode($reservation->inventory_supplies) !!};
            const inventoryQuantities = {!! json_encode($reservation->inventory_quantities) !!};

            inventorySupplies.forEach((supplyId, index) => {
                const inventoryCheckbox = document.getElementById('inventory_' + supplyId);
                if (inventoryCheckbox) {
                    inventoryCheckbox.checked = true;
                    const quantityInput = document.getElementById('quantity_' + supplyId);
                    if (quantityInput) {
                        quantityInput.value = inventoryQuantities[index];
                    }
                }
            });
        }
    });
</script>

</body>
</html>
@endsection

@extends('layouts.app')

@section('navTheme')
{{ 'dark' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection

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

    <!-- Button styling -->
    <style>
        .button-container a,
        .button-container button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-container a {
            background-color: #CE3232;
            color: white;
        }

        .button-container a:hover {
            background-color: #dfe1e2;
            color: black;
            transition-duration: 0.8s;
        }

        .button-container button {
            background-color: #CE3232;
            color: white;
        }

        .button-container button:hover {
            background-color: #dfe1e2;
            color: black;
            transition-duration: 0.8s;

            
        }

        .bold-divider {
            font-weight: bold; /* Make text bold */
            height: 2px; /* Increase height to make the line bolder */
            background-color: darkorange; /* Ensure the line is visible */
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;

        }
    </style>
</head>

@section('content')
<style>
.menu-title {
    text-align: center;
    font-style: italic;
    color: black;
    font-size: 30px;
}

.bg-custom-color {
    background-color: #CE3232;
}

.bg-custom-color:hover {
    background-color: #dfe1e2;
    transition-duration: 0.8s;
}

.text-custom {
    color: white;
}

.text-custom:hover {
    color: black;
    transition-duration: 0.8s;
}

.gradient-hr {
    border: none; /* Remove default border */
    height: 4px; /* Adjust height as needed */
    background: linear-gradient(to right, #000000, #FF8C00, #dc3545); /* Black to dark orange to danger red */
    border-radius: 8px;
}

.border-gradient {
    border-image: linear-gradient(to right, black, #FF8C00, #dc3545)1;
}

.gradient-bg {
    background: linear-gradient(to right, rgba(0, 0, 0, 10), rgba(255, 165, 0, 0.6), rgba(255, 0, 0, 0.5));
    padding: 0.5rem; /* Add some padding */
}

</style>
<section class="banner">
    
        <br><br><br><br><br>
        @if (Auth::check() && auth()->user()->role == 'customer')
        <div class="container w-full  mx-auto">
        <table class="table table-hover">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
            <h2 class="d-flex justify-content-center menu-title">MAKE RESERVATION</h2>
            <br>
        </div>
        </table>
        <hr class="my-4 gradient-hr">
            <div class="flex items-center min-h-screen bg-gray-50">
                <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                    <div class="flex flex-col md:flex-row">
                        <div class="flex-1">
                            <div class="container mx-auto max-w-screen-xl">
                                <div class="flex items-center justify-center p-6">
                                    <div class="w-full">
                                    <div class="w-full bg-gray-100 rounded-full border-1 border-transparent border-gradient">
                                            <div class="w-40 p-1 text-xs font-medium leading-none text-center rounded-full">
                                                Step 1
                                            </div>
                                        </div>
                                       <br>
                                       <form method="POST" action="{{ route('reservations.store.step.one') }}" class="w-full md:w-1/2">
                                @csrf
                                <!-- Email Input -->
                                <div class="sm:col-span-6">
                                    <div class="p-1">
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        <div class=" text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                        <svg class="w-6 h-6 mr-1" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                            <span class="text-xs block text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Email</span>
                                        </div>
                                    </label>
                                    <div class="mt-1 inline-flex flex-col items-center ">
                                        <div class="inline-flex items-center">
                                            <!-- Email Icon -->
                                            <svg class="fill-current h-6 w-6 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 14.016L4 9.96l1.415-1.414L12 13.186l6.585-5.64L20 9.96 12 16.016z" />
                                            </svg>
                                            <span class="input-group-text py-1 px-1 rounded-md gradient-bg ">
                                            <span class="inline-flex items-center px-2 py-2 border border-transparent text-sm leading-4 font-xs rounded-md text-gray-500 bg-white hover:text-gray-700 transition ease-in-out duration-150" style="width: 215px;">
                                                <div>{{ Auth::user()->email }}</div>
                                            </span>
                                            </span>
                                        </div>
                                        <div class="w-24 px-2 py-1 mt-1 text-xs font-medium leading-none text-center text-gray-700 bg-gray-200 rounded-md">Your Email Account</div>
                                    </div>
                                    </div>
                                </div>
                          
                                <!-- First Name Input -->
                                <div class="sm:col-span-6">
                                    <hr class="my-1 mt-1 gradient-hr">
                                    <label for="first_name" class="block text-sm font-medium text-gray-700">
                                        <div class="mt-2 p-1 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                            <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                            <span class="text-xs block text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">First Name  
                                            <span class="input-group-text py-1 px-1 rounded-md gradient-bg ">
                                                <input type="text" id="first_name" name="first_name" value="{{ $reservation->first_name ?? '' }}" 
                                                 style="width: 210px;"
                                                class="block w-full max-w-xs appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                            </span>
                                            </span>
                                        </div>
                                    </label>
                                    @error('first_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Last Name Input -->
                                <div class="sm:col-span-6">
                                    <hr class="my-1 mt-1 gradient-hr">
                                    <label for="last_name" class="block text-sm font-medium text-gray-700">
                                        <div class="mt-2 p-1 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                            <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                            <span class="text-xs block text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Last Name 
                                            <span class="input-group-text py-1 px-1 rounded-md gradient-bg ">
                                                <input type="text" id="last_name" name="last_name" value="{{ $reservation->last_name ?? '' }}" 
                                                style="width: 210px;"
                                                class="block w-full max-w-xs appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                            </span>
                                            </span>
                                        </div>
                                    </label>
                                    @error('last_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                               <!-- Phone Number Input -->
                                <div class="sm:col-span-6">
                                    <hr class="my-1 mt-1 gradient-hr">
                                    <label for="tel_number" class="block text-sm font-medium text-gray-700">
                                        <div class="mt-2 p-1 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                            <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                            <span class="text-xs block text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Phone Number 
                                            <span class="input-group-text py-1 px-1 rounded-md gradient-bg">&nbsp;<h1 class="text-white">+63</h1>&nbsp;&nbsp;
                                            <input type="text" id="tel_number" name="tel_number" value="{{ $reservation->tel_number ?? '' }}" 
                                                pattern="\d{10}" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" 
                                                style="width: 170px;"
                                                class="w-full max-w-xs appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                            </span>
                                            </span>
                                        </div>
                                    </label>
                                    @error('tel_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Guest Number Input -->
                                <div class="sm:col-span-6">
                                    <hr class="my-1 mt-1 gradient-hr">
                                    <label for="guest_number" class="block text-sm font-medium text-gray-700">
                                        <div class="mt-2 p-1 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                            <svg class="w-6 h-6 mr-1" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                            <span class="text-xs block text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Guest Number
                                            <span class="input-group-text py-1 px-1 rounded-md gradient-bg ">
                                            <input type="number" id="guest_number" name="guest_number" value="{{ $reservation->guest_number ?? '' }}" 
                                            style="width: 150px;" 
                                            class="w-full max-w-xs appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                            </span>
                                            </span>
                                        </div>
                                    </label>
                                    @error('guest_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Reservation Date -->
                                <div class="sm:col-span-6">
                                     <hr class="my-1 mt-1 gradient-hr">
                                    <label for="res_date" class="block text-sm font-medium text-gray-700">
                                        <div class="mt-2 p-1 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                            <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                            <span class="text-xs block text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Reservation Date 
                                            <span class="input-group-text py-1 px-1 rounded-md gradient-bg ">
                                                <input type="datetime-local" id="res_date" name="res_date" min="{{ now()->format('Y-m-d\TH:i') }}" value="{{ optional($reservation)->res_date ? \Carbon\Carbon::parse($reservation->res_date)->format('Y-m-d\TH:i') : '' }}" class="w-full max-w-xs appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                </span>
                                                <div class="mt-2 p-2 text-sm text-gray-700 bg-yellow-100 flex items-center">
                                                    <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18h.01M9 21h6a2 2 0 002-2v-4a8 8 0 10-8 0v4a2 2 0 002 2z"></path></svg>
                                                    <span class="text-xs">Please choose the time between 08:00 AM and 10:00 PM.</span>
                                                </div>
                                            </span>
                    
                                        </div>
                                    </label>
                                    
                                    @error('res_date')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                          
                                            <!--div class="mt-4 p-4 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                              
                                                <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18h.01M9 21h6a2 2 0 002-2v-4a8 8 0 10-8 0v4a2 2 0 002 2z"></path>
                                                </svg>
                                             
                                                <span>Please ensure all your details are accurate. We will reach out to you promptly once your reservation is confirmed.</span>
                                            </div-->
                                            <br>
                                            <div class="my-3 dropdown-divider bold-divider gradient-hr"></div>
                                            <br>

                                            <div class="d-flex flex-wrap align-items-center gap-4">
                                                <!-- Events Button -->
                                                <a href="{{ route('cservices.index') }}" class="px-4 py-2 btn btn-custom-color primary-btn flex-shrink-0">Events</a>
                                                
                                                <!-- Note Message -->
                                                <div class="flex items-center p-2 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex-grow min-w-0">
                                                    <!-- Icon for visual emphasis -->
                                                    <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18h.01M9 21h6a2 2 0 002-2v-4a8 8 0 10-8 0v4a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <!-- Text message -->
                                                    <span class="text-xs sm:text-sm md:text-base">Please ensure all your details are accurate. We will reach out to you promptly once your reservation is confirmed.</span>
                                                </div>
                                                
                                                <!-- Next Button -->
                                                <button type="submit" class="px-4 py-2 btn btn-custom-color primary-btn flex-shrink-0" id="btnNext">Next</button>
                                            </div>

                                            <!--div class="button-container mt-2 p-4 flex justify-between">
                                                <a href="{{ route('cservices.index') }}" class="px-4 py-2 btn btn-custom-color primary-btn">Events</a>
                                                <button type="submit" class="px-4 py-2 btn btn-custom-color primary-btn" id="btnNext">Next</button>
                                            </div-->
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--div class="calendar-container flex-1">
                            <div id="calendar"></div>
                        </div-->
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
      <hr class="my-4 gradient-hr">
</section>
<!--script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        });
        calendar.render();
    });
</script-->
@endsection
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixler Events</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="bg-black text-white font-hanken-grotesk pb-20">
    <div class="">
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto"
                            src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="">
                    </a>
                </div>
                <div class="flex lg:hidden" id="show_div">
                    <button type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white-700">
                        <span class="sr-only">Open main menu</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
                <div class="hidden lg:flex lg:gap-x-12">
                    <a href="{{ route('home') }}" class="text-sm/6 font-semibold text-white-900">Home</a>

                    <a href="{{ route('events') }}" class="text-sm/6 font-semibold text-white-900">Events</a>

                    <a href="{{ route('categories') }}" class="text-sm/6 font-semibold text-white-900">Categories</a>

                    
                    @roleor('attendee', 'organizer')
                        <a href="{{ route('events.my') }}" class="text-sm/6 font-semibold text-white-900">My Events</a>
                    @endroleor

                    @role('organizer')
                        <a href="{{ route('manage.events.my') }}" class="text-sm/6 font-semibold text-white-900">Event Management</a>
                    @endrole

                    @role('admin')
                        <a href="{{ route('admin.events.approve') }}" class="text-sm/6 font-semibold text-white-900">Event Management</a>
                        <a href="{{ route('admin.users.index') }}" class="text-sm/6 font-semibold text-white-900">User Management</a>
                    @endrole




                    {{-- <a href="#" class="text-sm/6 font-semibold text-white-900">Features</a> --}}
                    {{-- <a href="#" class="text-sm/6 font-semibold text-white-900">Marketplace</a> --}}
                    {{-- <a href="#" class="text-sm/6 font-semibold text-white-900">Company</a> --}}
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">

                    @guest
                        <x-forms.link-button href="{{ route('register') }}">
                            Sign up
                        </x-forms.link-button>

                        <x-forms.link-button href="{{ route('login') }}">
                            Log in
                        </x-forms.link-button>
                    @endguest

                    @auth
                        <button href="#" class="text-sm/6 font-semibold text-white-900 mr-3" form="logout_form">Log out</button>

                        {{-- For editing a profile --}}
                        <x-forms.link-button href="{{ route('profile.edit') }}">
                            <i class="fa-solid fa-user"></i>
                        </x-forms.link-button>

                        {{-- For logout --}}
                        <form action="{{ route('logout') }}" method="POST" class="hidden" id="logout_form">
                            @csrf
                            @method('DELETE')
                        </form>

                    @endauth

                    {{-- <a href="{{ route('register') }}" class="text-sm/6 font-semibold text-white-900">Sign up <span
                        aria-hidden="true"></span></a>
                    <a href="{{ route('login') }}" class="text-sm/6 font-semibold text-white-900">Log in <span
                            aria-hidden="true">&rarr;</span></a> --}}
                </div>
            </nav>
            <!-- Mobile menu, show/hide based on menu open state. -->
            <div class="hidden " role="dialog" aria-modal="true" id="menuDiv">
                <!-- Background backdrop, show/hide based on slide-over state. -->
                <div class="fixed inset-0 z-50"></div>
                <div
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-dark/500 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10 fixed inset-0 bg-red bg-opacity-50 backdrop-blur-sm z-10">
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-8 w-auto"
                                src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="">
                        </a>
                        <button type="button" class="-m-2.5 rounded-md p-2.5 text-white-700" id="closeButton">
                            <span class="sr-only">Close menu</span>
                            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                
                                    <a href="{{ route('home') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white-900 hover:bg-gray-50">Home</a>

                    <a href="{{ route('events') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white-900 hover:bg-gray-50">Events</a>

                    <a href="{{ route('categories') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white-900 hover:bg-gray-50">Categories</a>

                    
                    @roleor('attendee', 'organizer')
                        <a href="{{ route('events.my') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white-900 hover:bg-gray-50">My Events</a>
                    @endroleor

                    @role('organizer')
                        <a href="{{ route('manage.events.my') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white-900 hover:bg-gray-50">Event Management</a>
                    @endrole

                    @role('admin')
                        <a href="{{ route('admin.events.approve') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white-900 hover:bg-gray-50">Event Management</a>
                        <a href="{{ route('admin.users.index') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white-900 hover:bg-gray-50">User Management</a>
                    @endrole
                            </div>
                            <div class="py-6">
                                

                                @guest
                                    <x-forms.link-button href="{{ route('register') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white-900 hover:bg-gray-50">
                                        Sign up
                                    </x-forms.link-button>

                                    <x-forms.link-button href="{{ route('login') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white-900 hover:bg-gray-50">
                                        Log in
                                    </x-forms.link-button>
                                @endguest

                                @auth
                                    <button href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white-900 hover:bg-gray-50" form="logout_form">Log out</button>

                                    {{-- For editing a profile --}}
                                    <x-forms.link-button href="{{ route('profile.edit') }}">
                                        <i class="fa-solid fa-user"></i>
                                    </x-forms.link-button>

                                    {{-- For logout --}}
                                    <form action="{{ route('logout') }}" method="POST" class="hidden" id="logout_form">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="my-10 max-w-[986px] mx-auto mt-custom-100">
            {{ $slot }}
        </main>

    </div>




</body>

</html>

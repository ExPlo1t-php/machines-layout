<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-gray-100 mb-3">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="object-left-top object-scale-down h-1/4 w-1/4"/>
                    </a>
                </div>  

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('injection')" :active="request()->routeIs('injection')">
                        {{ __('Injection') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('assembly')" :active="request()->routeIs('assembly')">
                        {{ __('Assembly') }}
                    </x-nav-link>
                </div>
                @if (session()->get('username'))
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                @endif
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('traceability')" :active="request()->routeIs('traceability')">
                        {{ __('Traceability') }}
                    </x-nav-link>
                </div>

            </div>
        {{-- sidenav menu --}}
                <x-slider></x-slider>
    </div>
</nav>

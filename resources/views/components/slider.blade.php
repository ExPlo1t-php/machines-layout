
<!-- drawer init and toggle -->
<div class="text-center self-center">
    <button class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-slate-600 dark:hover:bg-slate-700 focus:outline-none dark:focus:ring-slate-800" type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
        <i class="fa-solid fa-bars"></i>
    </button>
 </div>
 
 <!-- drawer component -->
 <div id="drawer-right-example" class="overflow-y-auto fixed z-40 p-4 w-80 h-screen bg-white dark:bg-gray-800 transition-transform right-0 top-0 transform-none" tabindex="-1" aria-labelledby="drawer-right-label" aria-modal="true" role="dialog">
    <button type="button" data-drawer-dismiss="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Close menu</span>
     </button>
               {{-- checking if user exists (logged in) --}}
               @if (session()->get('username'))
               <!-- Settings Dropdown -->
               <div class=" flex-col sm:flex-col sm:items-center sm:ml-6 text-center mt-10">
               <div class="text-xl text-indigo-900">{{ Auth::user()->name }}</div>
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
               
               <!-- Authentication -->
               <form method="get" action="{{ route('dashboard') }}">
                   @csrf
                   
                   <x-dropdown-link :href="route('dashboard')"
                           onclick="event.preventDefault();
                           this.closest('form').submit();">
                       {{ __('Dashboard') }}
                   </x-dropdown-link>
               </form>
               
               <form method="POST" action="{{ route('logout') }}">
                   @csrf
                   
                   <x-dropdown-link :href="route('logout')"
                           onclick="event.preventDefault();
                           this.closest('form').submit();">
                       {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
                
                <div class="text-md text-italic text-indigo-900 mt-6 ">Navigation</div>
                  <div :class="{'block': open, 'lg:hidden': ! open}" class="lg:hidden>
                        <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('General Layout') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('injection')" :active="request()->routeIs('injection')">
                        {{ __('Injection') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('assembly')" :active="request()->routeIs('assembly')">
                        {{ __('Assembly') }}
                    </x-responsive-nav-link>
                </div>
               </div>
                <div class="text-md text-italic text-indigo-900 mt-6 ">Admin controls</div>
                <ul class="flex flex-col pt-4 pb-1 border-t border-gray-200">
                    <x-dashboard-buttons :href="route('cabinet')" :active="request()->routeIs('cabinet')">
                    {{ __('Add a Network cabinet') }}
                </x-dashboard-buttons>
                <x-dashboard-buttons :href="route('switch')" :active="request()->routeIs('switch')">
                    {{ __('Add a Switch') }}
                </x-dashboard-buttons>
                <x-dashboard-buttons :href="route('lines')" :active="request()->routeIs('lines')">
                    {{ __('Add an Assembly line') }}
                </x-dashboard-buttons>
                <x-dashboard-buttons :href="route('station')" :active="request()->routeIs('station')">
                    {{ __('Add a Station') }}
                </x-dashboard-buttons>
                <x-dashboard-buttons :href="route('equipment')" :active="request()->routeIs('equipment')">
                    {{ __('Add an Equipment') }}
                </x-dashboard-buttons>
                <x-dashboard-buttons :href="route('station-type')" :active="request()->routeIs('station-type')">
                    {{ __('Add a new station type') }}
                </x-dashboard-buttons>
                <x-dashboard-buttons :href="route('equipment-type')" :active="request()->routeIs('equipment-type')">
                    {{ __('Add a new equipment type') }}
                </x-dashboard-buttons>
                </ul>
            </div>
            </div>
               @else
                <div class="flex-col sm:flex-col sm:items-center sm:ml-6 text-center mt-10">
                    <x-dropdown-link :href="route('login')" class="text-xl"> {{ __('Login') }}</x-dropdown-link>
                    <p class="text-xs text-gray-400">There's no user connected <span class="text-indigo-500">Log In</span> to unlock admin controls</p>
                    </div>
                    <div :class="{'block': open, 'lg:hidden': ! open}" class="lg:hidden>
                        <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('General Layout') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('injection')" :active="request()->routeIs('injection')">
                        {{ __('Injection') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('assembly')" :active="request()->routeIs('assembly')">
                        {{ __('Assembly') }}
                    </x-responsive-nav-link>
                </div>
               @endif

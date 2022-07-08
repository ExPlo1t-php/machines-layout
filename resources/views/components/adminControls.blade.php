<div class=" h-100 w-1/2 bg-white rounded p-10 flex justify-center">
  <div class="w-screen flex flex-col self-center justify-center">
    {{-- the form will load here 👇--}}
    {{$slot}}
    </div>
</div>


<div class="flex justify-end ">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-14 bg-white border-b border-gray-300 ">
            <ul class="flex flex-col">
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
</div>


</div>


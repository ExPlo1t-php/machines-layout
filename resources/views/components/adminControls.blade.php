
<div class=" h-100 w-1/2 bg-white rounded p-10 flex place-content-center align-self-center justify-self-center">
    {{$slot}}
    <div class="w-screen">
        <form class="w-full max-w-lg">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  Cabinet Name
                </label>
                <input class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="password" placeholder="Cabinet name">
              </div>
            </div>

            
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  Zone
                </label>
                <input class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="password" placeholder="Cabinet Zone (location)">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Description
            </label>
            <textarea name="description"  cols="53" rows="10" placeholder="Write a description of this network cabinet" style="resize: none" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
          </div>
        </div>
        <input class="flex place-self-center bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" type="submit" name="submit">
          </form>
    </div>
</div>

<div class="py-8 flex justify-end ">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-14 bg-white border-b border-gray-300 ">
            <ul class="flex flex-col">
                <x-dashboard-buttons :href="route('addCabinet')" :active="request()->routeIs('addCabinet')">
                {{ __('Add a new cabinet') }}
            </x-dashboard-buttons>
            <x-dashboard-buttons :href="route('addCabinet')" :active="request()->routeIs('addCabinet')">
                {{ __('Add a new cabinet') }}
            </x-dashboard-buttons>
            <x-dashboard-buttons :href="route('addCabinet')" :active="request()->routeIs('addCabinet')">
                {{ __('Add a new cabinet') }}
            </x-dashboard-buttons>
            <x-dashboard-buttons :href="route('addCabinet')" :active="request()->routeIs('addCabinet')">
                {{ __('Add a new cabinet') }}
            </x-dashboard-buttons>
            <x-dashboard-buttons :href="route('addCabinet')" :active="request()->routeIs('addCabinet')">
                {{ __('Add a new cabinet') }}
            </x-dashboard-buttons>
            <x-dashboard-buttons :href="route('addCabinet')" :active="request()->routeIs('addCabinet')">
                {{ __('Add a new cabinet') }}
            </x-dashboard-buttons>
            <x-dashboard-buttons :href="route('addCabinet')" :active="request()->routeIs('addCabinet')">
                {{ __('Add a new cabinet') }}
            </x-dashboard-buttons>
            </ul>
        </div>
    </div>
</div>
</div>
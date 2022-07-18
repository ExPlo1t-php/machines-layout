<x-app-layout>


    <div id="box" class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 bg-white border-b border-gray-200 text-green-400">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-around">
        <x-adminControls>
            @if (Route::currentRouteName()=='dashboard')
            <div class="text-center">
                <h1 class="text-2xl">welcome to the admin's dashboard</h1>
                <p>here you can add and manage your stations, <br>
                    equipments, and machines</p>
                </div>
            @else
            @yield('component')
            @endif
        </x-adminControls>
    </div>
    <div class="table w-full flex  p-4 bg-gray-200"">
        <div class="flex justify-center ">
            <h1 class="m-3 text-center text-xl">Available elements</h1>
            <div class="form-group">
                <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                type="search" id="search" name="search" placeholder="Search">
            </div>
        </div>
        
        @yield('table')
    </div>
    <script>
        setTimeout(() => {
            // 👇️ hiding the logged in status after 5 seconds
          const box = document.getElementById('box');

          // 👇️ removes element from DOM
          box.style.display = 'none';

        }, 3000); 

        
    </script>
    
</x-app-layout>

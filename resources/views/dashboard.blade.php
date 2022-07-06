<x-app-layout>


    <div id="box" class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-green-400">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-around">
        <x-adminControls></x-adminControls>
    </div>
    <script>
        setTimeout(() => {
            // 👇️ hiding the logged in status after 5 seconds
          const box = document.getElementById('box');

        //   // 👇️ removes element from DOM
          box.style.display = 'none';

        }, 5000); 

        
    </script>
    
</x-app-layout>

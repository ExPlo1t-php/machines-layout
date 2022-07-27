<x-app-layout>
    <div class="container mx-auto flex-col items-center justify-center text-center px-2">
        <h2 class="text-center py-8 text-4xl">welcome to the layout</h2>
        <p class="w-auto m-auto">A quick and easy way to check the company's layout, <br> machines/stations placement or status, connected ports, switch cabinet placement .... etc</p>
    </div>
    <div class="flex justify-around my-10 items-center">
        <div onclick="location.href='/injection'" class="bg-cover w-1/2 h-full text-white py-24 px-10 object-fill" style="background-image: url(/assets/images/injection.png)">
            <div class="md:w-1/2">
             <p class="font-bold text-sm uppercase">Injection Layout</p>
             </div>  
         </div>
        <div onclick="location.href='/assembly'" class="bg-cover  w-1/3 h-full text-white py-24 px-10 object-fill " style="background-image: url(/assets/images/assembly.png);">
            <div class="md:w-1/2">
             <p class="font-bold text-sm uppercase">Assembly Lines Layout</p>
             </div>  
         </div>
    </div>

</x-app-layout>
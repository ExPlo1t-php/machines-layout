<x-app-layout>
    @section('title', 'Layout | Home')
    <div class="container mx-auto flex-col items-center justify-center text-center px-2">
        <h2 class="text-center py-8 text-4xl">welcome to the layout</h2>
        <p class="w-auto m-auto">A quick and easy way to check the company's layout, <br> machines/stations placement or status, connected ports, switch cabinet placement .... etc</p>
    </div>
    <style>
.inj{
    background: url(/assets/images/injection2.jpg);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.assm{
    background: url(/assets/images/assembly2.jpg);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.bg-text {
  background-color: rgba(0,0,0, 0.7); /* Black w/opacity/see-through */
  color: white;
  font-weight: bold;
  border: 3px solid #f1f1f1;
  z-index: 0;
  padding: 20px;
  text-align: center;
}

.bg-text:hover{
    background-color: rgba(0,0,0, 0.25); 
    cursor: pointer;
}
    </style>
    <div class="flex justify-around my-10 items-center overflow-hidden">
        <div onclick="location.href='/injection'" class="inj bg-cover m-10 w-1/2 h-full text-white py-24 px-10 object-fill rounded-lg text-center flex justify-center">
                <span class="bg-text font-bold text-lg uppercase text-black">Injection Layout</span>
         </div>
        <div onclick="location.href='/assembly'" class="assm bg-cover m-10 w-1/2 h-full text-white py-24 px-10 object-fill rounded-lg text-center flex justify-center">
             <span class="bg-text font-bold text-lg uppercase text-black text-center">Assembly Lines Layout</span>
         </div>
    </div>

</x-app-layout>
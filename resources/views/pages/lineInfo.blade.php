<x-app-layout>
@section('title', 'Layout | Line Info')
    <!-- component -->


    @if (isset($index[0]))
    <div class="container w-full h-fit right mx-auto grid gap-3 grid-cols-2 grid-rows-1 p-5 h-screen place-items-center flex ">
        <div>
            @foreach ($stations->skip(0)->take(5) as $station)
            <div class="bg-white hover:bg-gray-400 shadow-md m-10 border border-gray-200 rounded-lg max-w-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="p-10">
                    <a href="/stationInfo/{{$station->name}}">
                    <h5 class="text-gray-900 text-center font-bold text-xl tracking-tight mb-2 dark:text-white">{{$station->name}}</h5>
                    </a>
   
                </div>
            </div>
            @endforeach
        </div>
        <div>
            @foreach ($stations->skip(5)->take(5) as $station)
            <div class="bg-white hover:bg-gray-400 shadow-md m-10 border border-gray-200 rounded-lg max-w-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="p-10">
                    <a href="#">
                        <h5 class="text-gray-900 text-center font-bold text-xl tracking-tight mb-2 dark:text-white">{{$station->name}}</h5>
                    </a>
   
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
@else
<div class="flex flex-col h-32 justify-center items-center">
    <h1 class="text-center text-2xl text-bold">{{$status}}</h1>
    <a href="/assembly" class="text-center text-cyan-400 underline text-md">go back <i class="fa-solid fa-arrow-right"></i></a>
</div>
@endif
</x-app-layout>
<x-app-layout>
@section('title', 'Layout | Line Info')
    <!-- component -->


@php
        echo $index;
@endphp
{{-- <section class="relative pt-13 bg-blueGray-50 max-h-screen overflow-hidden">
<div class="container mx-4"> 
<div class="flex flex-wrap w-screen content-between items-center">
    <div class="w-10/12 md:w-6/12 lg:w-4/12 px-12 md:px-4 mr-auto ml-auto -mt-78">
    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-gray-300">
        <img alt="..." src="/assets/images/machines/bnb.png" class="w-1/4 align-middle rounded-t-lg rotate-90 align-center self-center">
        <h1 class="text-center font-semibold text-md">line Details</h1>
        <ul class="border border-gray-200 rounded overflow-hidden shadow-md text-left">
            
            
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">line name: </span> {{$line->name}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">line type: </span> {{$line->type}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">line line: </span> {{$line->line}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Serial number: </span> {{$line->SN}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">line supplier: </span> {{$line->supplier}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Main Ip Address: </span> {{$line->mainIpAddr}} 
                @php
                $ip = $line->mainIpAddr;
                $ping = exec('ping -n 1 '.$ip, $output, $status);
                if($status == 1){
                    echo  '<i class="fa-solid fa-circle w-2/12 text-xs text-red-600 text-right">offline</i>';
                }elseif ($status == 0) {
                    echo  '<i class="fa-solid fa-circle  w-2/12 text-xs text-green-500 text-right">Live</i>';
                }else{
                    echo  '<i class="fa-solid fa-circle  w-2/12 text-xs text-orange-500 text-right">Error</i>';
                }
            @endphp
            </li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Port: </span> @if (!$line->port)there's no port @endif{{$line->port}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Description: </span> @if (!$line->description)there's no description @endif{{$line->description}}</li>
        </ul>
    </div>
        </div>

        <div class="w-screen h-screen md:w-6/12">
            <div class="flex flex-wrap h-fit">
                <div class="w-full md:w-6/12 px-4">
                    <div class="relative flex flex-col mt-4 ">
                        <div class="px-4 py-5 flex-auto">
                            <h6 class="text-xl mb-1 font-semibold">About connected switch</h6>
                            <ul class="border border-gray-200 rounded overflow-hidden shadow-md text-left">         
                                <li class="px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Cabinet name: </span> {{$cabinet->name}}</li>
                                <li class="px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Cabinet zone: </span> {{$cabinet->zone}}</li>
                                <li class="px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Switch ip address: </span> {{$switch->ipAddr}}</li>
                                <li class="px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Switch number of ports: </span> {{$switch->portsNum}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section> --}}
</x-app-layout>
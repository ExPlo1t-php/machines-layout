<x-app-layout>
    @section('title', 'Layout | Station Info')
    {{-- @php
        print_r($switch->switchId);
        echo '<br>';
        print_r($cabinet->name);
        echo '<br>';
        print_r($station->mainIpAddr);
    @endphp --}}
    <!-- component -->



<section class="relative pt-13 bg-blueGray-50">
<div class="container mx-4">
  <div class="flex flex-wrap w-screen content-between items-center">
    <div class="w-10/12 md:w-6/12 lg:w-4/12 px-12 md:px-4 mr-auto ml-auto -mt-78">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-gray-300">
        <img alt="..." src="/assets/images/machines/bnb.png" class="w-1/4 align-middle rounded-t-lg rotate-90 align-center self-center">
        <h1 class="text-center font-semibold text-md">Station Details</h1>
        <ul class="border border-gray-200 rounded overflow-hidden shadow-md text-left">
            
            
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station name: </span> {{$station->name}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station type: </span> {{$station->type}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station line: </span> {{$station->line}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Serial number: </span> {{$station->SN}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station supplier: </span> {{$station->supplier}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Main Ip Address: </span> {{$station->mainIpAddr}} 
                @php
                $ip = $station->mainIpAddr;
                $ping = exec('ping -n 1 '.$ip, $output, $status);
                if($status == 1){
                    echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600 text-right flex">offline</i>';
                }elseif ($status == 0) {
                    echo  '<i class="fa-solid fa-circle text-green-500 text-right">Live</i>';
                }else{
                    echo  '<i class="fa-solid fa-circle text-orange-500 text-right">Error</i>';
                }
            @endphp</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Port: </span> @if (!$station->port)there's no description @endif{{$station->port}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Description: </span> @if (!$station->description)there's no description @endif{{$station->description}}</li>
        </ul>
      </div>
    </div>

    <div class="w-screen h-screen md:w-6/12">
      <div class="flex flex-wrap">
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
    <div class="relative flex flex-col min-w-0">
        <div class="px-4 py-5 flex-auto">
                <div class="text-blueGray-500 p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-white">
                  <i class="fas fa-sitemap"></i>
                </div>
              <h6 class="text-xl mb-1 font-semibold">
                Connected Equipments
              </h6>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</section>
</x-app-layout>
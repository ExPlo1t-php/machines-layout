<x-app-layout>
  @section('title', 'Layout | Station Info')
    <!-- component -->

<section class="relative pt-13 bg-blueGray-50 max-h-screen overflow-hidden">
<div class="container mx-4"> 
  <div class="flex flex-wrap w-screen content-between items-center">
    <div class="w-10/12 md:w-6/12 lg:w-4/12 px-12 md:px-4 mr-auto ml-auto -mt-78">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-gray-300">
        @if ($station->type!== 'assembly')
        <img alt="..." src="/assets/images/machines/{{$station->type}}.png" class="w-1/4 align-middle rounded-t-lg rotate-90 align-center self-center">
        @endif
        <h1 class="text-center font-semibold text-md">Station Details</h1>
        <ul class="border border-gray-200 rounded overflow-hidden shadow-md text-left">
            
            
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station name: </span>{{$station->name}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station type: </span> {{$station->type}}</li>
            @if ($station->line!==null)
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station line: </span> {{$station->line}}</li>
            @endif
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Serial number: </span> {{$station->SN}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station supplier: </span> {{$station->supplier}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Main Ip Address: </span> {{$station->mainIpAddr}} 
              @php
                $ip = $station->mainIpAddr;
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
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Switch: </span> {{$station->switch}} 
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Port: </span> @if (!$station->port)there's no port @endif{{$station->port}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Description: </span> @if (!$station->description)there's no description @endif{{$station->description}}</li>
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
    <div class="relative flex flex-col min-w-full w-auto h-fit">
      <div class="px-4 py-5 flex-auto ">
              <div class="text-blueGray-500 p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-white">
                <i class="fas fa-sitemap"></i>
              </div>
            <h6 class="text-xl mb-1 font-semibold">
              Connected Equipments
            </h6> 
            <div class="relative flex flex-col mt-4  h-56 overflow-auto">
              <div class="px-4 py-5 flex-auto">
                <ul class="border border-gray-200 rounded shadow-md text-left">         
                  @if ($equipments == [])
                  <li>there are no equipments</li>
                  @else
                  @foreach ($equipments as $equipment)
                  @php
                  $type = $eqtype->where('name', '=', $equipment->type)[0];
                  @endphp
                  <li class="flex px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out">
                      <img class="w-14 h-14 rounded-full" src="/Image/{{$type->icon}}">
                      <div class="block">
                    {{$equipment->name}}
                    <div class="flex items-center text-gray-400">
                          {{$equipment->type}}
                          {{$equipment->IpAddr}}
                          @php
                      $ip = $equipment->IpAddr;
                      $ping = exec('ping -n 1 '.$ip, $output, $status);
                      if($status == 1){
                        echo  '<i class="fa-solid fa-circle w-1/12 m-5 text-xs text-red-600"></i>';
                      }elseif ($status == 0) {
                        echo  '<i class="fa-solid fa-circle w-1/12 m-5 text-xs text-green-500"></i>';
                      }else{
                          echo  '<i class="fa-solid fa-circle  w-1/12 m-5 text-xs text-orange-500"></i>';
                        }
                        @endphp
                        </div>
                  </div>
                </li>
                  @endforeach
                  @endif
                </ul>
              </div>
            </div>
            
            
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</section>
</x-app-layout>
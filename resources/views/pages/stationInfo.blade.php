<x-app-layout>
  @section('title', 'Layout | Station Info')
    <!-- component -->

<section class="relative pt-13 bg-blueGray-50 max-h-screen bg-gray-100">
<div class="container mx-4">
  <div class="flex flex-wrap w-screen content-between items-center">
    <div class="w-10/12 md:w-6/12 mb-32 lg:w-4/12 px-12 md:px-4 mr-auto ml-auto -mt-78">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-gray-300">
        @php
        // if the station has no type the image will not load
          $typereq = $stType->where('name', '=', $station->type);
        if(!$typereq->isEmpty()){
          $index1 = $typereq->keys()[0];
          $sttype = $typereq[$index1];
        }
        @endphp
        @if(!$typereq->isEmpty())
        <img alt="..." src="/assets/images/machines/{{$sttype->icon}}" class="w-1/4 align-middle rounded-t-lg align-center self-center">
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
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Main Ip Address: </span> {{$station->mainIpAddr}}</li>
            {{-- if the station type is bmb show additional ip addresses --}}
            @if (strtolower($station->type) == 'bmb')
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Ip Address N1: </span> {{$station->IpAddr1}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Ip Address N2: </span> {{$station->IpAddr2}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Ip Address N3: </span> {{$station->IpAddr3}}</li>
            @endif
            <x-detailsitem>
              <x-detailsspan>
                Status:
              </x-detailsspan>
              @php
              if($station->state !== 1){
              $ip = $station->mainIpAddr;
              $ping = exec('ping -n 1 -w 1000 '.$ip, $output, $status);
              if($status == 1){
                  echo  '<i class="fa-solid fa-circle w-2/12 text-xs text-red-600 text-right">offline</i>';
              }elseif ($status == 0) {
                  echo  '<i class="fa-solid fa-circle  w-2/12 text-xs text-green-500 text-right">Live</i>';
              }else{
                echo  '<i class="fa-solid fa-circle  w-2/12 text-xs text-orange-500 text-right">Error</i>';
              }
            }
              @endphp
              </x-detailsitem>
            @if(!is_null($station->switch))
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Switch: </span> {{$switch->switchName}}</li>
            @endif
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Port: </span> @if (!$station->port)there's no port @endif{{$station->port}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Description: </span> @if (!$station->description)there's no description @else {{$station->description}} @endif</li>
              <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Link: </span> @if (!$station->link)there's no embedded link @else <a href="{{$station->link}}"  target="_blank" class="text-blue-700"> {{$station->link}} </a>@endif</li>
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
                @if (isset($switch) && isset($cabinet))
                <x-detailsitem>
                  <x-detailsspan>
                    Cabinet name:
                  </x-detailsspan>
                  {{$cabinet->name}}
                </x-detailsitem>
                {{--  --}}
                <x-detailsitem>
                  <x-detailsspan>
                    Cabinet zone:
                  </x-detailsspan>
                  {{$cabinet->zone}}
                </x-detailsitem>
                {{--  --}}
                <x-detailsitem>
                  <x-detailsspan>
                    Switch ip address:
                  </x-detailsspan>
                  {{$switch->ipAddr}}
                </x-detailsitem>
                {{--  --}}
                <x-detailsitem>
                  <x-detailsspan>
                    Switch number of ports:
                  </x-detailsspan>
                  {{$switch->portsNum}}
                </x-detailsitem>
                @else
                <x-detailsitem>
                  <x-detailsspan>
                    There's no switch / cabinet
                  </x-detailsspan>
                </x-detailsitem>
                @endif
            </ul>
        </div>
    </div>
    <div class="relative flex flex-col min-w-full w-auto h-fit">
      <div class="py-5 flex-auto ">
            <div class="text-blueGray-500 p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-white">
              <i class="fas fa-sitemap"></i>
            </div>
          <h6 class="text-xl mb-1 font-semibold">
            Connected Equipments
          </h6>
          <div class="relative flex flex-col mt-4  h-56 overflow-auto">
            <div class="px-4 py-5 flex-auto">
              <ul class="border border-gray-200 rounded shadow-md text-left">
                @if ($equipments == '')
                <li>there are no equipments</li>
                @else
                @if(session()->get('username'))
                  <li onclick="location.href='/equipment/{{$station->SN}}'" class="flex px-4 py-3 border-b last:border-none border-gray-200 hover:bg-gray-200 text-gray-500 transition-all duration-300 ease-in-out cursor-pointer">
                    &#x2b; Add a new equipment
                  </li>
                @endif
                @foreach ($equipments as $equipment)
                @php
                $type = $eqtype->where('name', '=', $equipment->type);
                @endphp
                <li class="flex px-4 py-3 border-b last:border-none border-gray-200 hover:bg-gray-200 text-gray-500 transition-all duration-300 ease-in-out cursor-pointer" data-modal-toggle="{{$equipment->name}}modal">
                  <img class="w-14 h-14 rounded-full" src="/assets/images/equipments/{{$type[$type->keys()[0]]->icon}}">
                  <div class="block">
                    {{$equipment->name}}
                    <div class="flex items-center text-gray-400">
                        {{$equipment->type}}
                        @if($equipment->IpAddr)
                          {{$equipment->IpAddr}}
                          @php
                          if($equipment->state == 1){
                          $ip = $equipment->IpAddr;
                          $ping = exec('ping -n 1 -w 1000 '.$ip, $output, $status);
                          if($status == 1){
                            echo  '<i class="fa-solid fa-circle w-1/12 m-5 text-xs text-red-600"></i>';
                          }elseif ($status == 0) {
                            echo  '<i class="fa-solid fa-circle w-1/12 m-5 text-xs text-green-500"></i>';
                          }else{
                              echo  '<i class="fa-solid fa-circle  w-1/12 m-5 text-xs text-orange-500"></i>';
                            }
                          }
                          @endphp
                        @endif
                    </div>
                  </div>
                  </li>
                  {{-- -------------------------------------modal------------------------------------------------------------------------- --}}
                  <div id="{{$equipment->name}}modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Details of {{$equipment->name}}
                                  </h3>
                                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="{{$equipment->name}}modal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                  </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-6 flex items-center">
                                    <img class="w-28 h-28 rounded-full" src="/assets/images/equipments/{{$type[$type->keys()[0]]->icon}}">
                                    <div class="px-4 flex-auto">
                                      <ul class="rounded overflow-hidden shadow-md text-left">
                                        @if (isset($equipment))
                                        <x-detailsitem>
                                          <x-detailsspan>
                                            Equipment name:
                                          </x-detailsspan>
                                          {{$equipment->name}}
                                          </x-detailsitem>
                                          {{--  --}}
                                        <x-detailsitem>
                                          <x-detailsspan>
                                            Equipment serial number:
                                          </x-detailsspan>
                                          {{$equipment->SN}}
                                          </x-detailsitem>
                                          {{--  --}}
                                        <x-detailsitem>
                                          <x-detailsspan>
                                            Equipment type:
                                          </x-detailsspan>
                                          {{$equipment->type}}
                                          </x-detailsitem>
                                          {{--  --}}
                                        <x-detailsitem>
                                          <x-detailsspan>
                                            Equipment supplier:
                                          </x-detailsspan>
                                          {{$equipment->supplier}}
                                          </x-detailsitem>
                                          {{--  --}}
                                        <x-detailsitem>
                                          <x-detailsspan>
                                            Equipment ip address:
                                          </x-detailsspan>
                                          @if($equipment->IpAddr =='')
                                            This item doesn't have an ip address
                                          @else
                                          {{$equipment->IpAddr}}
                                          @endif
                                          </x-detailsitem>
                                          {{--  --}}
                                        <x-detailsitem>
                                          <x-detailsspan>
                                            Connected port:
                                          </x-detailsspan>
                                          {{$equipment->port}}
                                          </x-detailsitem>
                                          {{--  --}}
                                        <x-detailsitem>
                                          <x-detailsspan>
                                            description:
                                          </x-detailsspan>
                                          @if($equipment->description =='')
                                            there's no description
                                          @else
                                          {{$equipment->description}}
                                          @endif
                                          </x-detailsitem>
                                        @else
                                        <li class="px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">There's no switch / cabinet </span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            {{-- <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                <button data-modal-toggle="{{$equipment->name}}modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">hide details</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
                {{-- -------------------------------------modal------------------------------------------------------------------------- --}}
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

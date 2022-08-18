<x-app-layout>
    @section('title', 'Layout | Assembly lines layout')
    <link rel="stylesheet" href="/css/draggable.css">
        <div class="container flex p-5 h-screen w-full">
            @foreach ($lines as $line)
            <div 
                style="top:{{$line->posTop}}px; left:{{$line->posLeft}}px;"
                 class="{{$line->id}} w-1/12 h-full flex flex-col items-center justify-center text-center md:text-md sm:text-sm text-white bg-black/40 cursor-move ">
                <h1>{{$line->name}}</h1>
                <span
                onclick="location.href='/lineInfo/{{$line->id}}'"
                class="bg-black w-full m-1 p-1 rounded-md hover:hover:bg-black/10 cursor-pointer ease-in-out md:text-sm sm:text-2xs"
                >Go to details</span>
                <form action="/linePos" method="POST">
                    @csrf
                    </form>
                    <script type="text/javascript">
                    $(document).ready(function(){
                    // making the DOM element with a specific class draggable
                    $('.{{$line->id}}').draggable({
                    // return to original position
                    @if (!session()->get('username'))
                        revert: true,
                    @endif
                    // movement axis
                    axis: "x",
                    // container grid
                    grid: [ 6, 6 ],
                    // execute a function on stop drag
                    @if (session()->get('username'))
                    stop: function(event,ui){
                        // get the position of the selected element
                        dragposition = ui.position;
                        var inputdrag = '<input type="hidden" id="pos{{$line->id}}" value="'+dragposition.left+','+dragposition.top+'"/>'
                        if ($('#pos{{$line->id}}').length){
                            $('#pos{{$line->id}}').remove();
                            $('.{{$line->id}} form').append(inputdrag);
                            }else{
                            $('.{{$line->id}} form').append(inputdrag);
                            }
                            // ajax send data from the hidden input
                            // create an array -> split input values into 3 array indexes
                            let data = [];
                            data.push(dragposition.top);
                            data.push(dragposition.left);
                            let token = "{{ csrf_token()}}";
                        $.ajax({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: `/linePos/{{{$line->id}}}`,
                            type: 'post',
                            data: {
                                // _token:token,
                                posTop:data[0],
                                posLeft:data[1],
                            },
                        })
                    // stop function end
                    }
                    @endif
                    });

                    })
                    </script>
            </div>
            @endforeach
            {{-- cabinet  --}}
            @if (isset($cabinets))
            @foreach ($cabinets as $cabinet)
            <div 
            style="top:{{$cabinet->posTop}}px; left:{{$cabinet->posLeft}}px;"
             class="cabinet{{$cabinet->id}} w-1/12 h-fit flex flex-col items-center justify-center text-center md:text-md sm:text-sm text-white bg-black/40 cursor-move ">
            <h1>{{$cabinet->name}}</h1>
            <img src="/assets/images/network/switchCabinet.png" alt="cabinet" class="rounded w-full">
            {{-- modal toggle --}}
            <span
            class="bg-black w-full m-1 p-1 rounded-md hover:hover:bg-black/10 cursor-pointer ease-in-out md:text-sm sm:text-2xs"
            data-modal-toggle="cabinet{{$cabinet->name}}"
            >Show details</span>
            {{-- modal --}}
            <div id="cabinet{{$cabinet->name}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full cursor-default">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Cabinet: {{$cabinet->name}}
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="cabinet{{$cabinet->name}}">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6 flex content-center">
                            <ul class="rounded overflow-hidden shadow-md text-left w-1/2">         
                                <x-detailsitem>
                                  <x-detailsspan>
                                    Cabinet name:
                                  </x-detailsspan>
                                  {{$cabinet->name}}
                                  </x-detailsitem>
                                  {{--  --}}
                                <x-detailsitem>
                                  <x-detailsspan>
                                    Cabinet description:
                                  </x-detailsspan>
                                  {{$cabinet->description}}
                                  </x-detailsitem>
                            </ul>
                            <div>
                                @php
                                    $switches = $switch->where('cabName', '=', $cabinet->name);
                                @endphp
                                
                                @foreach ($switches as $switch)
                                <div class="flex items-center m-3">
                                    <span class="text-black">{{$switch->id}}</span>
                                    <img src="/assets/images/network/switch.png" alt="switch" class="w-1/2 h-1/2">
                                    <span
                                    class="bg-black w-full h-fit m-1 p-1 rounded-md hover:hover:bg-black/10 cursor-pointer ease-in-out md:text-sm sm:text-2xs"
                                    data-modal-toggle="switch{{$switch->id .$switch->cabName}}"
                                    >show more info</span>
                                </div>
                                {{-- switch modal --}}
                                <div id="switch{{$switch->id .$switch->cabName}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full cursor-default" >
                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Switch: {{$switch->cabName . $switch->id}}
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="switch{{$switch->id .$switch->cabName}}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-6 space-y-6 flex content-center ">
                                                <ul class="rounded overflow-hidden shadow-md text-left w-1/2">         
                                                    <x-detailsitem>
                                                      <x-detailsspan>
                                                        Switch number of ports:
                                                      </x-detailsspan>
                                                      {{$switch->portsNum}}
                                                      </x-detailsitem>
                                                      {{--  --}}
                                                    <x-detailsitem>
                                                      <x-detailsspan>
                                                        Switch ip address:
                                                      </x-detailsspan>
                                                      {{$switch->ipAddr}}
                                                      </x-detailsitem>
                                                    <x-detailsitem>
                                                      <x-detailsspan>
                                                        Status:
                                                      </x-detailsspan>
                                                      @php
                                                      $ip = $switch->ipAddr;
                                                      $ping = exec('ping -n 1 '.$ip, $output, $status);
                                                      if($status == 1){
                                                          echo  '<i class="fa-solid fa-circle w-2/12 text-xs text-red-600 text-right">offline</i>';
                                                      }elseif ($status == 0) {
                                                          echo  '<i class="fa-solid fa-circle  w-2/12 text-xs text-green-500 text-right">Live</i>';
                                                      }else{
                                                        echo  '<i class="fa-solid fa-circle  w-2/12 text-xs text-orange-500 text-right">Error</i>';
                                                      }
                                                      @endphp
                                                      </x-detailsitem>
                                                </ul>
                                                <div class="flex-col w-1/2 content-center text-black">
                                                    <span>Available ports</span>
                                                    @if(isset($port))
                                                    @php
                                                    // specifying the collected ports
                                                    $ports = $port->where('switchId','=',$switch->id);
                                                    @endphp
                                                    <ul class="text-black ">
                                                        @foreach ($ports as $port)
                                                        <li
                                                        @if($port->assigned !== null)
                                                        class="flex justify-center text-right border-b last:border-none border-gray-300"
                                                        @else
                                                        class="flex justify-center text-right border-b last:border-none border-gray-300"
                                                        @endif
                                                        >
                                                        {{$port->portNum}}
                                                        @if($port->assigned !== null)
                                                       <span class="bg-red-300 ml-3  border-gray-200 text-gray-500">     used</span>
                                                       @else
                                                       <span class="bg-green-300 ml-3 border-gray-200 text-gray-500 ">      free</span>
                                                        @endif
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- switch modal --}}
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- modal --}}
            <form action="/cabinetPos" method="POST">
                @csrf
                </form>
                <script type="text/javascript">
                    $(document).ready(function(){
                    // making the DOM element with a specific class draggable
                    $('.cabinet{{$cabinet->id}}').draggable({
                    // return to original position
                    @if (!session()->get('username'))
                        revert: true,
                    @endif
                    //container aka walls
                    containment: 'main',
                    // scroll
                    scroll: true, scrollSensitivity: 100,
                    // container grid
                    grid: [ 6, 6 ],
                    // execute a function on stop drag
                    @if (session()->get('username'))
                    stop: function(event,ui){
                        // get the position of the selected element
                        dragposition = ui.position;
                        var inputdrag = '<input type="hidden" id="poscabinet{{$cabinet->id}}" value="'+dragposition.left+','+dragposition.top+'"/>'
                        if ($('#poscabinet{{$cabinet->id}}').length){
                            $('#poscabinet{{$cabinet->id}}').remove();
                            $('.cabinet{{$cabinet->id}} form').append(inputdrag);
                            }else{
                            $('.cabinet{{$cabinet->id}} form').append(inputdrag);
                            }
                            // ajax send data from the hidden input
                            // create an array -> split input values into 3 array indexes
                            let data = [];
                            data.push(dragposition.top);
                            data.push(dragposition.left);
                            let token = "{{ csrf_token()}}";
                        $.ajax({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: `/cabinetPos/{{{$cabinet->id}}}`,
                            type: 'post',
                            data: {
                                // _token:token,
                                posTop:data[0],
                                posLeft:data[1],
                            },
                        })
                    // stop function end
                    }
                    @endif
                    });
    
                    })
                    </script>
            </div>
                @endforeach
                @endif
        </div>


</x-app-layout>
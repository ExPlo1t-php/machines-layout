<x-app-layout>
    @section('title', 'Layout | Injection layout')
    <link rel="stylesheet" href="/css/draggable.css">
    {{-- -----------------------------top section--------------------------- --}}
    <div class="w-full h-auto mb-24 mr-0">
    <div class="top-container w-full h-auto border-2 border-current mx-1 p-3 flex grid grid-rows-5 grid-cols-12">
        @foreach ($stations as $station)
        <div
        style="top:{{$station->posTop}}px; left:{{$station->posLeft}}px;"
        class="{{$station->SN}} w-28 h-56 p-3 mx-5 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40  cursor-move draggable ui-widget-content">
            <div class="flex items-center justify-center">
                <h1>{{$station->name}}</h1>
                @php
 
                    $ip = $station->mainIpAddr;
                    $ping = exec('ping -n 1 '.$ip, $output, $status);
                    if($status == 1){
                        // offline
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600"></i>';
                    }elseif ($status == 0) {
                        // online
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-green-500"></i>';
                    }else{
                        // error
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-orange-500"></i>';
                    }
                    @endphp
            </div>
            <h1>{{$station->mainIpAddr}}</h1>
            @php
                $index = $type->where('name', '=', $station->type)->keys()[0];
                $stType = $type->where('name', '=', $station->type)[$index];
            @endphp
            <img src="/assets/images/machines/{{$stType->icon}}" alt="{{$station->name}}" class="m-auto p-0 object-fit ">
            <span
            onclick="location.href='/stationInfo/{{$station->name}}'" 
            class="bg-black w-full p-2 rounded-md hover:hover:bg-black/10 cursor-pointer ease-in-out"
            >Go to details</span>
        </div>
            <form action="/stationPos" method="POST">
            @csrf
            </form>
            <script type="text/javascript">
            $(document).ready(function(){
            // making the DOM element with a specific class draggable
            $('.{{$station->SN}}').draggable({
            // return to original position
            @if (!session()->get('username'))
            revert: true,
            @endif
            //container aka walls
            containment: '.top-container',  
            // container grid
            grid: [ 10 , 10 ],
            scroll: true,
            scrollSensitivity: 100,
            // execute a function on stop drag
            @if (session()->get('username'))
            stop: function(event,ui){
            // get the position of the selected element
            dragposition = ui.position;
            var inputdrag = '<input type="hidden" id="pos{{$station->SN}}" value="'+dragposition.left+','+dragposition.top+'"/>'
                if ($('#pos{{$station->SN}}').length){
                $('#pos{{$station->SN}}').remove();
                $('.{{$station->SN}} form').append(inputdrag);
                }else{
                $('.{{$station->SN}} form').append(inputdrag);
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
            url: `/stationPos/{{{$station->SN}}}`,
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
        @endforeach
    </div>
    </div>
</x-app-layout>
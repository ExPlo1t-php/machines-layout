<x-app-layout>  
    @section('title', 'Layout | Injection layout')
    <link rel="stylesheet" href="/css/draggable.css">
    {{-- -----------------------------top section--------------------------- --}}
    <div class="container w-full min-h-screen h-full border-2 border-current mx-1 p-3 flex overflow-auto">
        {{-- <div class="container flex p-5 h-screen w-full overflow-auto"> --}}
        @foreach ($stations as $station)
        <div
        style="top:{{$station->posTop}}px; left:{{$station->posLeft}}px;"
        class="{{$station->SN}} w-28 h-56 p-3 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40  cursor-move draggable ui-widget-content">
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
                $typereq =  $type->where('name', '=', $station->type);
                $index = $typereq->keys()[0];
                $stType = $typereq[$index];
            @endphp
            <img src="/assets/images/machines/{{$stType->icon}}" alt="{{$station->name}}" class="m-auto p-0 object-fit h-3/4">
            <span
            onclick="location.href='/stationInfo/{{$station->SN}}'" 
            class="bg-black w-full p-2 rounded-md sm:text-2xs md:text-2xs hover:hover:bg-black/10 cursor-pointer ease-in-out"
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
            containment: '.container',  
            // container grid
            grid: [ 6, 6 ],
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
</x-app-layout>
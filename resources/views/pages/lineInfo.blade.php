<x-app-layout>
@section('title', 'Layout | Line Info')
<div class="relative h-[1000px]">

    <!-- component -->
    @if (isset($index[0]))
    <div class="flex flex-col justify-center items-center">
        <a href="/station/{{request()->segment(2);}}" class="text-center text-cyan-400 underline text-xl">Add more stations</a>
    </div>
    @if($line[$line->keys()[0]]->icon!=="")
    <div class="flex self-center justify-end m-2">
        <img src="/assets/images/lines/{{$line[$line->keys()[0]]->icon}}" class="w-48 h-48 rounded-sm">
    </div>
    @endif
        <div>
            @foreach ($stations as $station)
            <div
            style="top:{{$station->posTop}}px; left:{{$station->posLeft}}px;"
            class="{{$station->SN}} bg-black/40 hover:bg-black/10  shadow-md m-1 border border-gray-200 rounded-lg w-28 dark:bg-gray-800 dark:border-gray-700 cursor-move">
                <div class="p-1  w-28 h-52">
                @php
                    $url = urlencode($station->SN);
                    $typereq = $stType->where('name', '=', $station->type);
                    $index = $typereq->keys()[0];
                    $sttype = $typereq[$index];
                @endphp
                <a href="/stationInfo/{{$url}}">
                  <h5 class="text-gray-900 hover:bg-gray-300 rounded text-center font-bold text-xl tracking-tight mb-2 dark:text-white">{{$station->name}}</h5>
                </a>
                <span >
                  <span>{{$station->mainIpAddr}}</span>
                  <span class="flex justify-center">
                  @php
                  if($station->state !== 1){
                    foreach ($ping as $p){
                        if($station->mainIpAddr == $p->ipAddr && $station->SN == $p->name){
                            if($p->state == 0){
                                // offline
                                echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600"></i>';
                            }elseif ($p->state == 1) {
                                // online
                                echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-green-500"></i>';
                            }
                        }
                    }
                }
                @endphp
                    </span>
                </span>
                <img alt="..." src="/assets/images/machines/{{$sttype->icon}}" class="p-0 h-[7.7rem] ">
                </div>
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
                // container grid
                grid: [ 10 , 10 ],
                scroll: true,
                scrollSensitivity: 100,
                // execute a function on stop drag
                @if (session()->get('username'))
                stop: function(event,ui){
                    console.log('hello');
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
            }).css("position", "absolute");;

                })
                </script>
            @endforeach
        </div>
    </div>
@else
<div class="flex flex-col h-32 justify-center items-center">
    <h1 class="text-center text-2xl text-bold">{{$status}}</h1>
    <a href="/assembly" class="text-center text-cyan-400 underline text-md">go back <i class="fa-solid fa-arrow-right"></i></a>
@endif

</div>
</x-app-layout>

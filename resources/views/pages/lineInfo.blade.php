<x-app-layout>
@section('title', 'Layout | Line Info')
    <!-- component -->


    @if (isset($index[0]))
    <div class="container w-full h-screen right mx-auto grid gap-3 grid-cols-2 grid-rows-1 p-5 h-screen place-items-center flex ">
        <div>
            @foreach ($stations as $station)
            <div 
            style="top:{{$station->posTop}}px; left:{{$station->posLeft}}px;"
            class="{{$station->SN}} bg-white  shadow-md m-1 border border-gray-200 rounded-lg max-w-sm dark:bg-gray-800 dark:border-gray-700 cursor-move">
                <div class="p-10 ">
                    @php
                    $url = urlencode($station->name);   
                    @endphp
                    <a href="/stationInfo/{{$url}}">
                    <h5 class="text-gray-900 hover:bg-gray-300 rounded text-center font-bold text-xl tracking-tight mb-2 dark:text-white">{{$station->name}}</h5>
                    </a>
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
                //container aka walls
                containment: '.container',  
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
            });
                
                })
                </script>
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
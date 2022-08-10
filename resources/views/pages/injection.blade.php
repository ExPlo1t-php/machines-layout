<x-app-layout>
    @section('title', 'Layout | Injection layout')
    <link rel="stylesheet" href="/css/draggable.css">
    {{-- -----------------------------top section--------------------------- --}}
    <div class="flex place-content-evenly grid grid-cols-2 gap-4 w-full mb-24">
    <div class="container w-full h-fit left border-2 border-current mx-auto ml-1 grid gap-6 grid-cols-6 grid-rows-1 p-5 h-screen place-items-center flex ">
        @foreach ($stations->skip(0)->take(4) as $station)
        <div onclick="location.href='/stationInfo/{{$station->name}}'" class="{{$station->name}} w-28 h-56 p-3 mx-5 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
            <div class="flex items-center justify-center">
                <h1>{{$station->name}}</h1>
                @php
 
                    $ip = $station->mainIpAddr;
                    $ping = exec('ping -n 1 '.$ip, $output, $status);
                    if($status == 1){
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }elseif ($status == 0) {
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-green-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }else{
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-orange-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }
                    @endphp
            </div>
            <h1>{{$station->mainIpAddr}}</h1>
            @php
                $index = $type->where('name', '=', $station->type)->keys()[0];
                $stType = $type->where('name', '=', $station->type)[$index];
            @endphp
            <img src="/assets/images/machines/{{$stType->icon}}" alt="{{$station->name}}" class="m-auto p-0 object-fit ">
        </div>
        @endforeach

    </div>

</div>
{{-- -----------------------------bottom section--------------------------- --}}
<div class="flex place-content-evenly w-full mb-24">

        
    <div class="top-container w-full h-fit border-2 border-current mx-auto mx-1 grid gap-6 grid-cols-12 grid-rows-1 p-5 h-screen place-items-center flex ">
        {{-- @foreach ($stations->where('name', '=', '') as $station) --}}
        @foreach ($stations->skip(4)->take(4) as $station)
        <div 
            style="{{$station->posTop}}px; left:{{$station->posLeft}}px;"
             class="{{$station->SN}} w-28 h-56 p-3 mx-5 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
            <div
            onclick="location.href='/stationInfo/{{$station->name}}'"
             class="flex items-center justify-center">
                <h1>{{$station->name}}</h1>
                @php
                    $ip = $station->mainIpAddr;
                    $ping = exec('ping -n 1 '.$ip, $output, $status);
                    if($status == 1){
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }elseif ($status == 0) {
                        echo  '<i class="fa-solid fa-circle text-green-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }else{
                        echo  '<i class="fa-solid fa-circle text-orange-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }
                    @endphp
            </div>
            <h1>{{$station->mainIpAddr}}</h1>
            
            <img src="/assets/images/machines/{{$stType->icon}}" alt="{{$station->name}}" class="m-auto p-0 object-fit ">
        </div>
<form action="/stationPos" method="POST">
@csrf
</form>
<script type="text/javascript">
$(document).ready(function(){
// making the DOM element with a specific class draggable
$('.{{$station->SN}}').draggable({
// return to original position
// revert: true,
//container aka walls
containment: '.top-container',
// container grid
grid: [ 70, 80 ],
// execute a function on stop drag
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
url: `stationPos/{{{$station->SN}}}`,
type: 'post',
data: {
    // _token:token,
    posTop:data[0],
    posLeft:data[1],
},
})
// stop function end
}});

})
</script>
        @endforeach

    </div>


</div>
</x-app-layout>
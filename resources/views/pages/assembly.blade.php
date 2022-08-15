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
//container aka walls
containment: '.container',
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
        </div>


</x-app-layout>
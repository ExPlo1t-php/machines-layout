<x-app-layout>
    @section('title', 'Layout | Assembly lines layout')
    <link rel="stylesheet" href="/css/draggable.css">
    <div class="flex">
        <div class="container mx-auto grid gap-4 col-start-1 row-start-1 grid-cols-8 grid-rows-1 p-5 h-screen">
            @foreach ($lines as $line)
            <div nclick="location.href='/lineInfo/{{$line->id}}'"
                style="{{$line->posTop}}px; left:{{$line->posLeft}}px;"
                 class="{{$line->id}} w-2/3 h-full mx-5 z-0 flex items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
                <h1>{{$line->name}}</h1>
                <form action="/linePos" method="POST">
                    @csrf
                    </form>
                    <script type="text/javascript">
$(document).ready(function(){
// making the DOM element with a specific class draggable
$('.{{$line->id}}').draggable({
// return to original position
// revert: true,
//container aka walls
containment: '.container',
// container grid
grid: [ 70, 80 ],
// execute a function on stop drag
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
        url: `linePos/{{{$line->id}}}`,
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
            </div>
            @endforeach
        </div>

</div>

</x-app-layout>
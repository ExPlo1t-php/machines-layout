<x-app-layout>
    {{$i = 0;}}
    @foreach ($coo as $coo)   
    @php
        $i++;
    @endphp     
    <div id="2-name"
    class="{{$coo->SN}}  w-28 h-28 p-3 bg-violet-900/40 m-0 w-fit"
    style="{{$coo->posTop}}px; left:{{$coo->posLeft}}px;"
    >{{$i}}
    <form action="/addor" method="POST">
        @csrf
    </form>
    </div>
    <script type="text/javascript">
$(document).ready(function(){
    // making the DOM element with a specific class draggable
    $('.{{$coo->SN}}').draggable({
        // return to original position
        revert: true,
        //container aka walls
        containment: 'main',
        // container grid
        grid: [ 80, 80 ],
        // execute a function on stop drag
        stop: function(event,ui){
            // get the position of the selected element
            dragposition = ui.position;
            var inputdrag = '<input type="hidden" id="pos{{$coo->SN}}" value="'+dragposition.left+','+dragposition.top+'"/>'
            if ($('#pos{{$coo->SN}}').length){
                $('#pos{{$coo->SN}}').remove();
                $('.{{$coo->SN}} form').append(inputdrag);
                }else{
                $('.{{$coo->SN}} form').append(inputdrag);
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
                url: `addor/{{{$coo->SN}}}`,
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
</x-app-layout>
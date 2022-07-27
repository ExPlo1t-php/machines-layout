@section('title', 'Layout | New station')
@extends('dashboard')

@section('component')
@if( Session::has('success') )
        <span id="successTxt" class="text-green-500 flex self-center">{{ Session::get('success') }}</span>
@endif
<form class="w-full max-w-lg flex-col self-center" method="POST" action="addStation" enctype="multipart/form-data">
    @csrf
    
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Station name
        </label>
        <input name="name" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="station name">
      </div>
    </div>
    
    <div class="help-tip">
      <p>This is the inline help tip! It can contain all kinds of HTML. Style it as you please.</p>
  </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Station type
        </label>
        
        <select name="type" id="type"
        onchange="let add = document.querySelector('.add');
        if(this.options[this.selectedIndex] == add){
        window.location = add.value;
        }"
        {{-- select option -> add button --}}
        class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
          <option value="null" selected disabled hidden >- select a station type -</option>
          {{-- fetching cabinet data to load in select menu --}}
          @php
              use App\Models\StationType;
              $types = StationType::get();
          @endphp
          @foreach ($types as $type)
          <option value="{{$type['name']}}"> {{$type['name']}}</option>
          @endforeach

          <option class="add" value="station-type">&#x2b; Add a new station type</option>
        </select>
      </div>
    </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Station's serial number
          </label>
          <input name="SN" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="number" placeholder="serial number format()">
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Supplier
          </label>
          <input name="supplier" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Supplier's name">
        </div>
      </div>

      <script>
        console.log($('#type').val())
        if($('#type').val()=='bnb'){
        var i = 3;
        for (i; i >= 1 ; i--) {
            var elem =  "<div id='ipAddr"+[i]+"' class='flex flex-wrap -mx-3 mb-6'><div class='w-full px-3'><label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-password'>ip address "+[i]+"</label><input name='ipAddr"+[i]+"' class='appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id='grid-password' type='text' placeholder='ip address "+[i]+"'></div></div>";
            // console.log(i);
           $(elem).insertAfter( "#ip" );
          }
      }
      $('#type').on('change', function() {
    if(this.value == 'bnb'){
      var i = 3;
      for (i; i >= 1 ; i--) {
          var elem =  "<div id='ipAddr"+[i]+"' class='flex flex-wrap -mx-3 mb-6'><div class='w-full px-3'><label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-password'>ip address "+[i]+"</label><input name='ipAddr"+[i]+"' class='appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id='grid-password' type='text' placeholder='ip address "+[i]+"'></div></div>";
          // console.log(i);
         $(elem).insertAfter( "#ip" );
        }
    }else{
    for (let j= 3; j >= 1 ; j--) {
      $(`#ipAddr${[j]}`).remove();
    }
  }
});
    </script>

      <div id="ip" class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            main ip address
          </label>
          <input name="mainIpAddr" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Main ip address format(xxx.xxx.xxx.xxx)">
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            switch name
          </label>
          <select name="switch"
          onchange="let add = document.querySelector('.add');
          if(this.options[this.selectedIndex] == add){
          window.location = add.value;
          }"
          {{-- select option -> add button --}}
          class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
            <option value="null" selected disabled hidden >- select a the switch connected to this station -</option>
            {{-- fetching cabinet data to load in select menu --}}
            @php
                use App\Models\CabinetSwitch;
                $switches = CabinetSwitch::get();
            @endphp
            @foreach ($switches as $switch)
            <option value="{{$switch['switchId']}}"> {{$switch['cabName']}} - {{ $switch['switchId']}}</option>
            @endforeach
  
            <option class="add" value="switch">&#x2b; Add a new switch</option>
          </select>
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            port
          </label>
          <input name="port" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="station port number">
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
           Assembly line name
          </label>
          <select name="line"
          onchange="let add = document.querySelector('.add');
          if(this.options[this.selectedIndex] == add){
          window.location = add.value;
          }"
          {{-- select option -> add button --}}
          class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
            <option value="null" selected disabled hidden >- select a the line where this station exist -</option>
            {{-- fetching cabinet data to load in select menu --}}
            @php
                use App\Models\Line;
                $lines = Line::get();
            @endphp
            @foreach ($lines as $line)
            <option value="{{$line['name']}}"> {{$line['name']}}</option>
            @endforeach
  
            <option class="add" value="line">&#x2b; Add a new assembly line</option>
          </select>
        </div>
      </div>

  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Description
      </label>
      <textarea name="description"  cols="53" rows="10" placeholder="Write a description of this Type of this equipment (optional)" style="resize: none" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
    </div>
  </div>

  <div class="flex justify-center">
    <input class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" type="submit" name="submit">
  </div>

  {{-- error handling --}}
  <div class="text-red-500 text-xs italic">
      <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
    </div>
    {{-- error handling --}}
    </form>
    
@endsection


@section('table')

    {{-- live search to station table --}}
    <script type="text/javascript">
  $('#search').on('keyup',function(){
  $value=$(this).val();
  $.ajax({
  type : 'get',
  url : '{{URL::to('searchStation')}}',
  data:{'search':$value},
  success:function(data){
  $('tbody').html(data);
  }
  });
  })
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
  // adding 3 inputs of ip if type == bnb
  if($('#type').value=='bnb'){
    var i = 3;
    for (i; i >= 1 ; i--) {
        var elem =  "<div id='ipAddr"+[i]+"' class='flex flex-wrap -mx-3 mb-6'><div class='w-full px-3'><label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-password'>ip address "+[i]+"</label><input name='ipAddr"+[i]+"' class='appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id='grid-password' type='text' placeholder='ip address "+[i]+"'></div></div>";
        // console.log(i);
       $(elem).insertAfter( "#ip" );
      }
  }

  </script>  
  {{-- live search to station table --}}

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
                Station name
            </th>
            <th scope="col" class="px-6 py-3">
                Station serial number
            </th>
            <th scope="col" class="px-6 py-3">
                Station supplier
            </th>
            <th scope="col" class="px-6 py-3">
                Station's main ip address
            </th>
            <th scope="col" class="px-6 py-3">
                Station's occupied port
            </th>
            <th scope="col" class="px-6 py-3">
                Station's occupied switch 
            </th>
            <th scope="col" class="px-6 py-3">
                Station line
            </th>
            <th scope="col" class="px-6 py-3">
                Station type
            </th>
            <th scope="col" class="px-6 py-3">
                Station description
            </th>
            <th scope="col" class="px-6 py-3">
              tools
            </th>
          </tr>
      </thead>
      <tbody>
        @php
            use App\Models\Station;
            $stations = Station::get();
        @endphp
          @foreach ($stations as $station)
          <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
              {{$station['name']}}
            </th>
            <td class="px-6 py-4">
              {{$station['SN']}}
            </td>
            <td class="px-6 py-4">
                {{$station['supplier']}}
              </td>
            <td class="px-6 py-4">
                {{$station['mainIpAddr']}}
              </td>
            <td class="px-6 py-4">
                {{$station['port']}}
              </td>
            <td class="px-6 py-4">
                {{$station['switch']}}
              </td>
            <td class="px-6 py-4">
                {{$station['line']}}
              </td>
            <td class="px-6 py-4">
                {{$station['type']}}
              </td>
            <td class="px-6 py-4">
                {{$station['description']}}
              </td>

              <td class="px-4 py-4 text-right flex">
                <a data-id="{{$station['name']}}" data-method="get" href="{{route('showStation', $station['name'])}}" id="edit" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                <a data-id="{{$station['SN']}}" data-method="DELETE" href="{{route('deleteStation', $station['SN'])}}" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
</div>

@endsection
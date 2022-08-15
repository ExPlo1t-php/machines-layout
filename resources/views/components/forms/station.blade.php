@section('title', 'Layout | New station')
@extends('dashboard')

@section('component')
@if( Session::has('success') )
        <span id="successTxt" class="text-green-500 flex self-center">{{ Session::get('success') }}</span>
@endif
<form class="w-full max-w-2xl flex-col self-center" method="POST" action="addStation" enctype="multipart/form-data">
    @csrf

    <div class="flex justify-between">
      <x-formInput class="w-full mr-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Station name
        </label>
        <input name="name" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="station name">
      </x-formInput>
      
      
    <div class="flex flex-wrap mb-6 w-full">
      <div class="w-full">
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
  </div>
    
  <div class="flex justify-between">
    <x-formInput class="w-full mr-3">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
      Station's serial number
    </label>
    <input name="SN" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="serial number">
  </x-formInput>

  <x-formInput>
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
      Supplier
    </label>
    <input name="supplier" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Supplier's name">
  </x-formInput>
</div>

      <script>
      //   console.log($('#type').val())
      //   if($('#type').val()=='bnb'){
      //   var i = 3;
      //   for (i; i >= 1 ; i--) {
      //       var elem =  "<div id='ipAddr"+[i]+"' class='flex flex-wrap  mb-6'><div class='w-full'><label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-password'>ip address "+[i]+"</label><input name='ipAddr"+[i]+"' class='appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id='grid-password' type='text' placeholder='ip address "+[i]+"'></div></div>";
      //       // console.log(i);
      //      $(elem).insertAfter( "#ip" );
      //     }
      // }
      // adding 3 inputs of ip if type == bnb
      $('#type').on('change', function() {
    if(this.value == 'bnb'){
      var i = 3;
      for (i; i >= 1 ; i--) {
          var elem =  "<div id='ipAddr"+[i]+"' class='flex flex-wrap  mb-6'><div class='w-full'><label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-password'>ip address "+[i]+"</label><input name='ipAddr"+[i]+"' class='appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id='grid-password' type='text' placeholder='ip address "+[i]+"'></div></div>";
          // console.log(i);
         $(elem).insertAfter( "#ip" );
        }
    }else{
    for (let j= 3; j >= 1 ; j--) {
      $(`#ipAddr${[j]}`).remove();
      console.log(j);
    }
  }
});
    </script>
  <x-formInput id="ip">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
      main ip address
    </label>
    <input name="mainIpAddr" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Main ip address format(xxx.xxx.xxx.xxx)">
  </x-formInput>

  <x-formInput>
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        port
      </label>
      <input name="port" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="station port number">
    </x-formInput>

 <div class="flex flex-wrap mb-6 w-full">
  <div class="w-full">
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

  <div class="flex flex-wrap  mb-6 w-full">
    <div class="w-full">
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
      {{-- notice --}}
      <div class="bg-orange-100 border-l-4 border-orange-400 text-orange-700 p-2" role="alert">
        <p class="font-bold">Notice</p>
        <p>for injection stations leave this blank.</p>
      </div>
    </div>
  </div>

    <x-formInput>
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Description
      </label>
      <textarea name="description"  cols="53" rows="10" placeholder="Write a description of this Type of this equipment (optional)" style="resize: none" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
    </x-formInput>

  <div class="flex justify-center">
    <input class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" type="submit" name="submit">
  </div>

  {{-- error handling --}}
  @if (!$errors->isEmpty())
        <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
          <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Danger</span>
          <div>
            <ul class="mt-1.5 ml-4 text-red-700 list-disc list-inside">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif
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
        var elem =  "<div id='ipAddr"+[i]+"' class='flex flex-wrap  mb-6'><div class='w-full'><label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-password'>ip address "+[i]+"</label><input name='ipAddr"+[i]+"' class='appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id='grid-password' type='text' placeholder='ip address "+[i]+"'></div></div>";
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
                @php
                 $url = urlencode($station['name']);   
                @endphp
                <a data-id="{{$station['name']}}" data-method="get" href="{{route('showStation', $url)}}" id="edit" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                <a data-id="{{$station['SN']}}" data-method="DELETE" href="{{route('deleteStation', $station['SN'])}}" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
</div>

@endsection
@section('searchBar')
<x-searchBar></x-searchBar>
@endsection
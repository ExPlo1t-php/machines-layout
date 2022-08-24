@section('title', 'Layout | New equipment')
@extends('dashboard')

@section('component')
{{-- update messages --}}
@if( Session::has('success') )
        <span id="successTxt" class="text-green-500 flex self-center m-5">{{ Session::get('success') }}</span>
@endif
@if( Session::has('error') )
        <span id="successTxt" class="text-red-500 flex self-center m-5">{{ Session::get('error') }}</span>
@endif
{{-- update messages --}}

{{-- changing the form action depending on the requested url --}}
    @if(isset($st))
      <form class="w-full max-w-2xl flex-col self-center" method="POST" action="/addEquipment/{{$st->SN}}" enctype="multipart/form-data">
    @else
      <form class="w-full max-w-2xl flex-col self-center" method="POST" action="/addEquipment" enctype="multipart/form-data">
    @endif
    @csrf
    {{-- changing the form action depending on the requested url --}}

    <div class="flex justify-between">
    <x-formInput class="pr-3 w-full">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
      equipment name
      </label>
      <input name="name" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="equipment name">
    </x-formInput>

      <x-formInput>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Equipment's serial number
        </label>
        <input name="SN" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="serial number">
        </x-formInput>
      </div>
        

      <div class="flex flex-wrap mb-6">
        <div class="w-full">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Equipment type
          </label>
          <select name="type"
          onchange="let add = document.querySelector('.add');
          if(this.options[this.selectedIndex] == add){
          window.location = add.value;
          }"
          {{-- select option -> add button --}}
          class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
            <option value="null" selected disabled hidden >- select an equipment type -</option>
            {{-- fetching cabinet data to load in select menu --}}
            @php
                use App\Models\EquipmentType;
                $types = EquipmentType::get();
                @endphp
            @foreach ($types as $type)
            <option value="{{$type['name']}}"> {{$type['name']}}</option>
            @endforeach
  
            <option class="add" value="equipment-type">&#x2b; Add a new equipment type</option>
          </select>
        </div>
      </div>

        <x-formInput>
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Equipment Supplier
          </label>
          <input name="supplier" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Supplier's name">
        </x-formInput>

        <x-formInput>
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            ip address
          </label>
          <input name="ipAddr" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Ip address format(xxx.xxx.xxx.xxx)">
        </x-formInput>


        <div class="flex flex-wrap w-full">
          <div class="w-full">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              switch name
            </label>
          <select name="switch" id="switch"
          onchange="let add = document.querySelector('.add2');
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
            <option value="{{$switch['id']}}"> {{$switch['cabName']}} - {{ $switch['switchNumber']}}</option>
            @endforeach
            
            <option class="add2" value="/switch">&#x2b; Add a new switch</option>
          </select>
        </div>
      
        
        <div class="flex flex-wrap mb-6 w-full">
          <div class="w-full">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              port
            </label>
            <select name="port" id="port"
            class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
              <option value="null" selected disabled hidden >- select the station's port number -</option>
            </select>
            <script>
              // using the select:switch value to fetch unused ports
              $('#switch').on('change',function(){
                $value=$(this).val();
                $.ajax({
                  type : 'get',
                  url : '{{URL::to('fetchFreePorts')}}',
                  data:{'switch':$value},
                  success:function(data){
                    console.log(data);
                    $('#port').html(data);
                  }
                });
                })
                $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                </script>
          </div>
          </div>
        </div>


      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
           station name
          </label>
          <select name="station"
          onchange="let add = document.querySelector('.add1');
          if(this.options[this.selectedIndex] == add){
          window.location = add.value;
          }"
          {{-- select option -> add button --}}
          class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
          @if(isset($st))
          <option value="{{$st['name']}}" selected hidden> {{$st['name']}}</option>
          @else
          <option value="null" selected disabled hidden >- select the station where this equipment exist -</option>
          @endif
            {{-- fetching cabinet data to load in select menu --}}
            @php
                use App\Models\Station;
                $stations = Station::get();
            @endphp
            @foreach ($stations as $station)
            <option value="{{$station['name']}}"> {{$station['name']}}</option>
            @endforeach
  
            <option class="add1" value="/lines">&#x2b; Add a new equipment</option>
          </select>
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
    {{-- live search --}}
   <script type="text/javascript">
      $('#search').on('keyup',function(){
        $value=$(this).val();
      $.ajax({
          type : 'get',
          url : '{{URL::to('searchEquipment')}}',
          data:{'search':$value},
          success:function(data){
          $('tbody').html(data);
          }
      });
      })
    </script>
    <script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>  
    {{-- live search --}}
    <script src="/js/sort.js"></script>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                equipment name
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                equipment serial number
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                equipment supplier
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                equipment's ip address
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                equipment's used switch
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                equipment's occupied port
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                equipment type 
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                Equipment station
            </th>
 
            <th scope="col" class="px-6 py-3 cursor-pointer">
                equipment description
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
              tools
            </th>
          </tr>
      </thead>
      <tbody>
        @php
            use App\Models\Equipment;
            $equipments = Equipment::paginate(7);
        @endphp
          @foreach ($equipments as $equipment)
          <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
              {{$equipment['name']}}
            </td>
            <td class="px-6 py-4">
              {{$equipment['SN']}}
            </td>
            <td class="px-6 py-4">
                {{$equipment['supplier']}}
              </td>
            <td class="px-6 py-4">
                {{$equipment['IpAddr']}}
              </td>
            <td class="px-6 py-4">
                {{$equipment['switch']}}
              </td>
            <td class="px-6 py-4">
                {{$equipment['port']}}
              </td>
            <td class="px-6 py-4">
                {{$equipment['type']}}
              </td>
              <td class="px-6 py-4">
                  {{$equipment['station']}}
                </td>
            <td class="px-6 py-4">
                {{$equipment['description']}}
              </td>
              <td class="px-4 py-4 text-right flex">
                @php
                $url = urlencode($equipment['name']);   
               @endphp
                <a data-id="{{$equipment['name']}}" data-method="get" href="{{route('showEquipment', $url)}}" id="edit" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                <a data-id="{{$equipment['SN']}}" data-method="DELETE" href="{{route('deleteEquipment', $equipment['SN'])}}" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$equipments->links('vendor/pagination/tailwind')}}
</div>

@endsection
@section('searchBar')
<x-searchBar></x-searchBar>
@endsection
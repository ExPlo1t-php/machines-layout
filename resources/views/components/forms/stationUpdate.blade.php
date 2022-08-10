@section('title', 'Layout | Update station')
@extends('dashboard')

@section('component')

<form class="w-full max-w-2xl flex-col self-center" method="POST" action="/updateStation/{{$station[$index]->name}}" enctype="multipart/form-data">
    @csrf
    
    <div class="flex justify-between">
      <x-formInput class="w-full mr-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Station name
        </label>
        <input value="{{$station[$index]->name}}" name="name" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="station name">
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
        <option value="{{$station[$index]->type}}" selected hidden > {{$station[$index]->type}}</option>
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
    

  <x-formInput>
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
      Supplier
    </label>
    <input name="supplier" value="{{$station[$index]->supplier}}" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Supplier's name">
  </x-formInput>


      <script>
  // adding 3 inputs of ip if type == bnb
      $('#type').on('change', function() {
    if(this.value == 'bnb'){
      console.log(this.value);
      var i = 3;
      for (i; i >= 1 ; i--) {
        var elem =  "<div id='ipAddr"+[i]+"' class='flex flex-wrap  mb-6'><div class='w-full'><label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-password'>ip address "+[i]+"</label><input name='ipAddr"+[i]+"' class='appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id='grid-password' type='text' placeholder='ip address "+[i]+"'></div></div>";
        // console.log(i);
        $(elem).insertAfter("#ip");
      }
    }else{
      console.log(this.value);
    for (let j= 3; j >= 1 ; j--) {
      $(`#ipAddr${[j]}`).remove();
    }
  }
});
    </script>
      <div class="flex flex-wrap -mx-3 mb-6" id="ip">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            main ip address
          </label>
          <input value="{{$station[$index]->mainIpAddr}}" name="mainIpAddr" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Main ip address format(xxx.xxx.xxx.xxx)">
        </div>
      </div>

      @if ($station[$index]->type == 'bnb')
      <div class="flex flex-wrap -mx-3 mb-6" id="ipAddr1">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Ip address 1
          </label>
          <input value="{{$station[$index]->IpAddr1}}" name="ipAddr1" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Ip address 1">
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6" id="ipAddr2">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Ip address 2
          </label>
          <input value="{{$station[$index]->IpAddr2}}" name="ipAddr2" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Ip address 2">
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6" id="ipAddr3">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Ip address 3
          </label>
          <input value="{{$station[$index]->IpAddr3}}" name="ipAddr3" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Ip address 3">
        </div>
      </div>
      @endif

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
            <option value="{{$station[$index]->switch}}" selected hidden >{{$station[$index]->switch}}</option>
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
          <input value="{{$station[$index]->port}}" name="port" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="station port number">
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
            <option value="{{$station[$index]->line}}" selected hidden > {{$station[$index]->line}}</option>
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
      <textarea name="description"  cols="53" rows="10" placeholder="Write a description of this Type of this equipment (optional)" style="resize: none" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{{$station[$index]->description}}</textarea>
    </div>
  </div>

  <div class="flex justify-center">
    <input class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" type="submit" value="update">
  </div>

  {{-- error handling --}}
  <div class="text-red-500 text-s text center italic">
      <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
    </div>
    {{-- error handling --}}
    </form>
@endsection


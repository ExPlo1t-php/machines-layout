@extends('dashboard')

@section('component')
<form class="w-full max-w-lg flex-col self-center" method="POST" action="addEquipment" enctype="multipart/form-data">
    @csrf
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
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
            <option value="null" selected disabled hidden >- select a the equipment type -</option>
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

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            equipment name
          </label>
          <input name="name" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="equipment name">
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Equipment's serial number
          </label>
          <input name="SN" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="number" placeholder="serial number format()">
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Equipment Supplier
          </label>
          <input name="supplier" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Supplier's name">
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            ip address
          </label>
          <input name="ipAddr" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Ip address format(xxx.xxx.xxx.xxx)">
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
           station name
          </label>
          <select name="station"
          onchange="let add = document.querySelector('.add');
          if(this.options[this.selectedIndex] == add){
          window.location = add.value;
          }"
          {{-- select option -> add button --}}
          class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
            <option value="null" selected disabled hidden >- select a the station where this equipment exist -</option>
            {{-- fetching cabinet data to load in select menu --}}
            @php
                use App\Models\Station;
                $stations = Station::get();
            @endphp
            @foreach ($stations as $station)
            <option value="{{$station['name']}}"> {{$station['name']}}</option>
            @endforeach
  
            <option class="add" value="line">&#x2b; Add a new station</option>
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
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
          <input name="port" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="equipment port number">
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
           equipment name
          </label>
          <select name="equipment"
          onchange="let add = document.querySelector('.add');
          if(this.options[this.selectedIndex] == add){
          window.location = add.value;
          }"
          {{-- select option -> add button --}}
          class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
            <option value="null" selected disabled hidden >- select a the equipment where this equipment exist -</option>
            {{-- fetching cabinet data to load in select menu --}}
            @php
                use App\Models\equipment;
                $equipments = equipment::get();
            @endphp
            @foreach ($equipments as $equipment)
            <option value="{{$equipment['name']}}"> {{$equipment['name']}}</option>
            @endforeach
  
            <option class="add" value="line">&#x2b; Add a new equipment</option>
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
    
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">
                equipment name
            </th>
            <th scope="col" class="px-6 py-3">
                equipment serial number
            </th>
            <th scope="col" class="px-6 py-3">
                equipment supplier
            </th>
            <th scope="col" class="px-6 py-3">
                equipment's ip address
            </th>
            <th scope="col" class="px-6 py-3">
                equipment's occupied port
            </th>
            <th scope="col" class="px-6 py-3">
                equipment type 
            </th>
            <th scope="col" class="px-6 py-3">
                Equipment station
            </th>
 
            <th scope="col" class="px-6 py-3">
                equipment description
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
            </th>
          </tr>
      </thead>
      <tbody>
        @php
            // use App\Models\Equipment;
            $equipments = Equipment::get();
        @endphp
          @foreach ($equipments as $equipment)
          <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
              {{$equipment['name']}}
            </th>
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
              <td class="px-6 py-4 text-right">
                  <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
              </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
</div>

@endsection
@extends('dashboard')

@section('component')
<form class="w-full max-w-lg flex-col self-center" method="POST" action="/updateSwitch/{{$switch[$index]->switchId}}">
    @csrf
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Switch location
          </label>
          <select name="cabName"
          onchange="let add = document.querySelector('.add');
          if(this.options[this.selectedIndex] == add){
          window.location = add.value;
          }"
          {{-- select option -> add button --}}
          class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
            {{-- fetching cabinet data to load in select menu --}}
            <option value="{{$switch[$index]->cabName}}" selected hidden>{{$switch[$index]->cabName}}</option>
            @php
                use App\Models\NetworkCabinet;
                $cabinets = NetworkCabinet::get();
            @endphp
            @foreach ($cabinets as $cabinet)
            <option value="{{$cabinet['name']}}"> {{$cabinet['name']}}</option>
            @endforeach

            <option class="add" value="cabinet">&#x2b; Add a new cabinet</option>
          </select>
        </div>
      </div>

      
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Ip Address
          </label>
          <input value="{{$switch[$index]->ipAddr}}" name="ipAddr" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" minlength="7" maxlength="15" size="15" id="grid-password" type="text" placeholder="Ip format (xxx.xxx.xxx.xxx)" required>
        </div>
    </div>
    
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                Number of ports
            </label>
            <input value="{{$switch[$index]->portsNum}}" name="portsNum" min="0" max="99" maxlength="2"  minlength="7" maxlength="15" size="15" id="grid-password" type="number" placeholder="Number of the switch's ports" required class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 appearance-none">
    </div>
  </div>
  <div class="flex justify-center">
    <input class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" type="submit" value="update">
  </div>
  {{-- error handling --}}
  <div class="text-red-500 text-xs italic">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
    </form>
@endsection
@section('title', 'Layout | New switch')
@extends('dashboard')

@section('component')
@if( Session::has('success') )
        <span id="successTxt" class="text-green-500 flex self-center">{{ Session::get('success') }}</span>
@endif
<form class="w-full max-w-lg flex-col self-center" method="POST" action="/addSwitch">
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
            <option value="null" selected disabled hidden >- select a network cabinet -</option>
            {{-- fetching cabinet data to load in select menu --}}
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
          <input name="ipAddr" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" minlength="7" maxlength="15" size="15" id="grid-password" type="text" placeholder="Ip format (xxx.xxx.xxx.xxx)" required>
        </div>
    </div>
    
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                Number of ports
            </label>
            <input name="portsNum" min="0" max="99" maxlength="2"  minlength="7" maxlength="15" size="15" id="grid-password" type="number" placeholder="Number of the switch's ports" required class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 appearance-none">
    </div>
  </div>
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
<script>
$('#search').on('keyup',function(){
  $value=$(this).val();
  $.ajax({
  type : 'get',
  url : '{{URL::to('searchSwitch')}}',
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
  {{-- live search to station table --}}
    
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">
                Switch Id
            </th>
            <th scope="col" class="px-6 py-3">
                Ip address
            </th>
            <th scope="col" class="px-6 py-3">
                Number of ports
            </th>
            <th scope="col" class="px-6 py-3">
                Cabinet name
            </th>
            <th scope="col" class="px-6 py-3">
              tools
            </th>
          </tr>
      </thead>
      <tbody>
        @php
            use App\Models\CabinetSwitch;
            $switchs = CabinetSwitch::paginate(7);
        @endphp
          @foreach ($switchs as $switch)
          <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
              {{$switch['id']}}
            </th>
            <td class="px-6 py-4">
              {{$switch['ipAddr']}}
            </td>
            <td class="px-6 py-4">
                {{$switch['portsNum']}}
              </td>
            <td class="px-6 py-4">
                {{$switch['cabName']}}
              </td>
              <td class="px-4 py-4 text-right flex">
                <a data-id="{{$switch['id']}}" data-method="get" href="{{route('showSwitch', $switch['id'])}}" id="edit" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                <a data-id="{{$switch['id']}}" data-method="DELETE" href="{{route('deleteSwitch', $switch['id'])}}" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$switchs->links('vendor/pagination/tailwind')}}
</div>

@endsection
@section('searchBar')
<x-searchBar></x-searchBar>
@endsection
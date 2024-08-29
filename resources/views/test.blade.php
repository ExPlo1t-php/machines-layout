     <x-app-layout>
        <div class="flex">
            @foreach ($cabinets as $cabinet)
            @php
            $switches = $switch->where('cabName', '=', $cabinet->name);
            @endphp
        
        @foreach ($switches as $switch)
        @php
        $ports = $port->where('switchId','=',$switch->switchNumber);
        @endphp
        <div>
            <span class="text-red-800">{{$switch->switchNumber}}</span>
            <ul>
          @foreach ($ports->keys() as $key)
          {{$ports[$key]->switchId}}
          @endforeach
            </ul>
        </div>
        @endforeach
        @endforeach
    </div>
    </x-app-layout> 
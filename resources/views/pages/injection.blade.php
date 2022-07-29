<x-app-layout>
    <link rel="stylesheet" href="/css/draggable.css">
    {{-- -----------------------------top section--------------------------- --}}
    <div class="flex place-content-evenly grid grid-cols-2 gap-4 w-full mb-24">

        
    <div class="container w-full h-fit left border-2 border-current mx-auto ml-1 grid gap-6 grid-cols-6 grid-rows-1 p-5 h-screen place-items-center flex ">
        {{-- @foreach ($stations->where('name', '=', 'sugogomous') as $station) --}}
        @foreach ($stations->skip(0)->take(4) as $station)
        <div onclick="location.href='/stationInfo/{{$station->name}}'" class="{{$station->name}} w-28 h-56 p-3 mx-5 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
            <div class="flex items-center justify-center">
                <h1>{{$station->name}}</h1>
                @php
                    $ip = $station->mainIpAddr;
                    $ping = exec('ping -n 1 '.$ip, $output, $status);
                    if($status == 1){
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }elseif ($status == 0) {
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-green-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }else{
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-orange-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }
                    @endphp
            </div>
            <h1>{{$station->mainIpAddr}}</h1>
            
            
            <img src="/assets/images/machines/bnb.png" alt="{{$station->name}}" class="m-auto p-0 object-fit ">
        </div>
        @endforeach

    </div>
    <div class="container w-full h-fit right border-2 border-current mx-auto ml-1 grid gap-6 grid-cols-6 grid-rows-1 p-5 h-screen place-items-center flex ">
        @foreach ($stations->skip(4)->take(3) as $station)
        <div onclick="location.href='/stationInfo/{{$station->name}}'" class="{{$station->name}} w-28 h-56 p-3 mx-5 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
            <div class="flex items-center justify-center">
                <h1>{{$station->name}}</h1>
                @php
                    $ip = $station->mainIpAddr;
                    $ping = exec('ping -n 1 '.$ip, $output, $status);
                    if($status == 1){
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }elseif ($status == 0) {
                        echo  '<i class="fa-solid fa-circle text-green-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }else{
                        echo  '<i class="fa-solid fa-circle text-orange-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }
                @endphp
            </div>
            <h1>{{$station->mainIpAddr}}</h1>
            
            <img src="/assets/images/machines/bnb.png" alt="{{$station->name}}" class="m-auto p-0 object-fit ">
        </div>
        @endforeach
    </div>

</div>
{{-- -----------------------------bottom section--------------------------- --}}
<div class="flex place-content-evenly grid grid-cols-2 gap-4 w-full mb-24">

        
    <div class="top container w-full h-fit border-2 border-current mx-auto ml-1 grid gap-6 grid-cols-6 grid-rows-1 p-5 h-screen place-items-center flex ">
        {{-- hehe boi 😆 --}}
        {{-- @foreach ($stations->where('name', '=', '') as $station) --}}
        @foreach ($stations->skip(0)->take(4) as $station)
        <div onclick="location.href='/stationInfo/{{$station->name}}'" class="{{$station->name}} w-28 h-56 p-3 mx-5 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
            <div class="flex items-center justify-center">
                <h1>{{$station->name}}</h1>
                @php
                    $ip = $station->mainIpAddr;
                    $ping = exec('ping -n 1 '.$ip, $output, $status);
                    if($status == 1){
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }elseif ($status == 0) {
                        echo  '<i class="fa-solid fa-circle text-green-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }else{
                        echo  '<i class="fa-solid fa-circle text-orange-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }
                    @endphp
            </div>
            <h1>{{$station->mainIpAddr}}</h1>
            
            
            <img src="/assets/images/machines/bnb.png" alt="{{$station->name}}" class="m-auto p-0 object-fit ">
        </div>
        @endforeach

    </div>
    <div class="bot container w-full h-fit border-2 border-current mx-auto ml-1 grid gap-6 grid-cols-6 grid-rows-1 p-5 h-screen place-items-center flex ">
        @foreach ($stations->skip(4)->take(3) as $station)
        <div onclick="location.href='/stationInfo/{{$station->name}}'" class="{{$station->name}} w-28 h-56 p-3 mx-5 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
            <div class="flex items-center justify-center">
                <h1>{{$station->name}}</h1>
                @php
                    $ip = $station->mainIpAddr;
                    $ping = exec('ping -n 1 '.$ip, $output, $status);
                    if($status == 1){
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }elseif ($status == 0) {
                        echo  '<i class="fa-solid fa-circle text-green-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }else{
                        echo  '<i class="fa-solid fa-circle text-orange-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }
                @endphp
            </div>
            <h1>{{$station->mainIpAddr}}</h1>
            
            <img src="/assets/images/machines/bnb.png" alt="{{$station->name}}" class="m-auto p-0 object-fit ">
        </div>
        @endforeach
    </div>

</div>
</x-app-layout>
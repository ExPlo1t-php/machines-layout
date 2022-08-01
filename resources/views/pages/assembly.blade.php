<x-app-layout>
    @section('title', 'Layout | Assembly lines layout')
    <link rel="stylesheet" href="/css/draggable.css">
    <div class="flex">
        <div class="container left mx-auto grid gap-4 grid-cols-8 grid-rows-1 p-5 h-screen">
            @foreach ($lines->skip(0)->take(4) as $line)
            <div onclick="location.href='/lineInfo/{{$line->name}}'" class="p1mt w-full h-full mx-5 z-0 flex items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
                <h1>{{$line->name}}</h1>
            </div>
            @endforeach
        </div>
        <div class="container right  mx-auto grid gap-4 grid-cols-8 grid-rows-1 p-5 h-screen">
            @foreach ($lines->skip(4)->take(3) as $line)
            <div class="p1mt w-full h-full mx-5 z-0 flex items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
                <h1>{{$line->name}}</h1>
            </div>
            @endforeach
        </div>

</div>
</x-app-layout>
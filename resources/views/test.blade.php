<x-app-layout>
    <h1 id="za-name"
    class="{{$coo[0]->className}} clickable w-28 h-56 p-3  mt-20 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900"
    style="position: absolute; top:{{$coo[0]->top}}px; left:{{$coo[0]->left}}px;"
    >goodevening</h1>
    
    {{-- <p id="ip"></p>
    <p id="ip1" class="bg-gray-200">height: </p>
    <p id="ip2" class="bg-green-200">width: </p>
    <p id="ip3" class="bg-blue-200"> </p>
    <form action="/addor" method="POST">
        @csrf
        <input type="text" id="class" name="className" value="">
        <input type="text" id="top" name="top" value="">
        <input type="text" id="left" name="left" value="">
        <input id="sub" type="submit" class="btn btn-primary">
    </form>
    --}}
</x-app-layout>
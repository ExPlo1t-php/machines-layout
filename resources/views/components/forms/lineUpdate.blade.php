@extends('dashboard')

@section('component')
<form class="w-full max-w-lg flex-col self-center" method="POST" action="/updateLine/{{$line[0]->name}}">
    @csrf
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Assembly Line name
          </label>
          <input value="{{$line[0]->name}}"  name="name" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Line name">
        </div>
      </div>

  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Description
      </label>
      <textarea  name="description"  cols="53" rows="10" placeholder="Write a description of this Assembly Line (optional)" style="resize: none" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{{$line[0]->description}}</textarea>
    </div>
  </div>
  <div class="flex justify-center">
    <input  class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" type="submit" name="update" value="update">
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
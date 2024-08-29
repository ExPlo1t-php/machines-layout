@section('title', 'Layout | New Assembly line')
@extends('dashboard')

@section('component')
{{-- update messages --}}
@if( Session::has('success') )
        <span id="successTxt" class="text-green-500 flex self-center m-5">{{ Session::get('success') }}</span>
@endif
@if( Session::has('error') )
        <span id="successTxt" class="text-red-500 flex self-center m-5">{{ Session::get('error') }}</span>
@endif
{{-- update messages --}}

<form class="w-full max-w-lg flex-col self-center" method="POST" action="/addLine" enctype="multipart/form-data">
    @csrf
    <x-formInput>
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Assembly Line name
          </label>
          <input  name="name" required class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Line name">
    </x-formInput>

    <x-formInput>
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Description
      </label>
      <textarea name="description"  cols="53" rows="10" placeholder="Write a description of this Assembly Line (optional)" style="resize: none" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
    </x-formInput>

    {{-- drag and drop image area --}}
    <div class="flex flex-col flex-grow max-w-xl mb-6">
        <div x-data="{ files: null }" id="FileUpload" class="block w-full py-2 px-3 relative bg-white appearance-none border-2 border-gray-300 border-dashed rounded-md cursor-pointer hover:border-gray-400 focus:outline-none">
            <input type="file" multiple accept="image/*" name="icon"
                   class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
                   x-on:change="files = $event.target.files; console.log($event.target.files);"
                   x-on:dragover="$el.classList.add('active')" x-on:dragleave="$el.classList.remove('active')" x-on:drop="$el.classList.remove('active')"
            >
            <template x-if="files !== null">
                <div class="flex flex-col space-y-1">
                    <template x-for="(_,index) in Array.from({ length: files.length })">
                        <div class="flex flex-row items-center space-x-2">
                            <template x-if="files[index].type.includes('image/')"><i class="far fa-file-image fa-fw"></i></template>
                            <span class="font-medium text-gray-900" x-text="files[index].name">Uploading</span>
                            <span class="text-xs self-end text-gray-500" x-text="filesize(files[index].size)">...</span>
                        </div>
                    </template>
                </div>
            </template>
            <template x-if="files === null">
                <div class="flex flex-col space-y-2 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <span class="font-medium text-gray-600">
                    Drop Images to Attach, or
                    <span class="text-blue-600 underline">browse</span>
                </span>
                </div>
            </template>
        </div>
    </div>
    {{-- drag and drop image area --}}

  <div class="flex justify-center">
    <input required class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" type="submit" name="submit">
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
    {{-- live search --}}
    <script type="text/javascript">
      $('#search').on('keyup',function(){
      $value=$(this).val();
      $.ajax({
      type : 'get',
      url : '{{URL::to('searchLine')}}',
      data:{'search':$value},
      success:function(data){
      $('tbody').html(data);
      }
      });
      })
      $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
      </script>
      {{-- live search --}}
      <script src="/js/sort.js"></script>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                Line name
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                Line Description
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                Line Icon
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
              tools
            </th>
          </tr>
      </thead>
      <tbody>
        @php
            use App\Models\Line;
            $lines = Line::paginate(7);
        @endphp
          @foreach ($lines as $line)
          <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
              {{$line['name']}}
            </td>
            <td class="px-6 py-4">
                {{$line['description']}}
              </td>
              <td class="px-6 py-4">
                @if($line['icon'])
                  <img src="/assets/images/lines/{{$line['icon']}}" alt="icon" class="w-20 h-20">
                  @endif
                </td>
              <td class="px-4 py-4 text-right flex">
                @php
                $url = urlencode($line['id']);
               @endphp
                <a data-id="{{$line['id']}}" data-method="get" href="{{route('showLine', $url)}}" id="edit" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                <a data-id="{{$line['id']}}" data-method="DELETE" href="{{route('deleteLine', $url)}}" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$lines->links('vendor/pagination/tailwind')}}
</div>

@endsection
@section('searchBar')
<x-searchBar></x-searchBar>
@endsection

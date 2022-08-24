@section('title', 'Layout | Manage layout users')
@extends('dashboard')

@section('component')
<form class="w-full max-w-lg flex-col self-center" method="POST" action="/addUser">
    @csrf
    <x-formInput>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Username
        </label>
        <input name="name" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text">
  </x-formInput>

  <x-formInput>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          User email
        </label>
        <input name="email" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text">
  </x-formInput>

  <x-formInput>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Password
        </label>
        <input name="password" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="password">
  </x-formInput>
  
  <x-formInput>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Repeat password
        </label>
        <input name="password_confirmation" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="password">
  </x-formInput>
    
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
@if( Session::has('success') )
        <span id="successTxt" class="text-green-500 flex self-center m-5">{{ Session::get('success') }}</span>
@endif
@if( Session::has('error') )
        <span id="successTxt" class="text-red-500 flex self-center m-5">{{ Session::get('error') }}</span>
@endif

    <script src="/js/sort.js"></script>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                User Id
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                Username
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                User email
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                <span class="sr-only">Edit</span>
            </th>
          </tr>
      </thead>
      <tbody>
  
        @if(count($users) > 0)
          @foreach ($users as $user)
          <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{$user['id']}}
            </td>
            <td class="px-6 py-4">
                {{$user['name']}}
            </td>
            <td class="px-6 py-4">
                {{$user['email']}}
            </td>
            <td class="px-4 py-4 text-right flex">
                <a data-id="{{$user['id']}}" data-method="get" href="{{route('user', $user['id'])}}" id="edit" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                <a data-id="{{$user['id']}}" data-method="DELETE" href="{{route('deleteUser', $user['id'])}}" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
            </td>
          </tr>
          @endforeach
        @else
          <tr>
              <td colspan="3" class="text-danger">no users found.</td>
          </tr>
        @endif
        </tbody>
      </table>
      {{$users->links('vendor/pagination/tailwind')}}
</div>

@endsection


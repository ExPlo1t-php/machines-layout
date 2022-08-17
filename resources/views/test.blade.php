     <x-app-layout>
         <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
             <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                 <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">
                      Station name
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Station serial number
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Station supplier
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Station's main ip address
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Station's occupied port
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Station's occupied switch 
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Station line
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Station type
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Station description
                  </th>
                  <th scope="col" class="px-6 py-3">
                    tools
                  </th>
                </tr>
            </thead>
            <tbody>
                @if ($stations->hasPages())
                @foreach ($stations as $station)
                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{$station['name']}}
                  </th>
                  <td class="px-6 py-4">
                    {{$station['SN']}}
                  </td>
                  <td class="px-6 py-4">
                      {{$station['supplier']}}
                    </td>
                  <td class="px-6 py-4">
                      {{$station['mainIpAddr']}}
                    </td>
                  <td class="px-6 py-4">
                      {{$station['port']}}
                    </td>
                  <td class="px-6 py-4">
                      {{$station['switch']}}
                    </td>
                  <td class="px-6 py-4">
                      {{$station['line']}}
                    </td>
                  <td class="px-6 py-4">
                      {{$station['type']}}
                    </td>
                  <td class="px-6 py-4">
                      {{$station['description']}}
                    </td>
      
                    <td class="px-4 py-4 text-right flex">
                      @php
                       $url = urlencode($station['name']);   
                      @endphp
                      <a data-id="{{$station['name']}}" data-method="get" href="{{route('showStation', $url)}}" id="edit" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                      <a data-id="{{$station['SN']}}" data-method="DELETE" href="{{route('deleteStation', $station['SN'])}}" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                  </td>
                </tr>
                @endforeach
                oof
                @endif
            </tbody>
        </table>
        {{$stations->links('vendor/pagination/tailwind')}}
      </div>


            </x-app-layout> 
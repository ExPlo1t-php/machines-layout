<x-app-layout>
  @section('title', 'Layout | Station Info')
    <!-- component -->

<section class="relative pt-13 bg-blueGray-50 bg-gray-100">
<div class="container mx-4">
  <div class="flex flex-wrap content-between items-center">
    <div class="w-10/12 md:w-6/12 mb-10 lg:w-4/12 px-12 md:px-4 mr-auto ml-auto -mt-78">
      <div class="relative flex flex-col min-w-0  w-full mb-6 shadow-lg rounded-lg bg-gray-300">
        @php
        // if the station has no type the image will not load
          $typereq = $stType->where('name', '=', $station->type);
        if(!$typereq->isEmpty()){
          $index1 = $typereq->keys()[0];
          $sttype = $typereq[$index1];
        }
        @endphp
        @if(!$typereq->isEmpty())
        <img alt="..." src="/assets/images/machines/{{$sttype->icon}}" class="w-1/4 align-middle rounded-t-lg align-center self-center">
        @endif
        <h1 class="text-center font-semibold text-md">Station Details</h1>
        <ul class="border border-gray-200 rounded overflow-hidden shadow-md text-left">


            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station name: </span>{{$station->name}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station type: </span> {{$station->type}}</li>
            @if ($station->line!==null)
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station line: </span> {{$station->line}}</li>
            @endif
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Serial number: </span> {{$station->SN}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station supplier: </span> {{$station->supplier}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Main Ip Address: </span> {{$station->mainIpAddr}}</li>
            {{-- if the station type is bmb show additional ip addresses --}}
            @if (strtolower($station->type) == 'bmb')
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Ip Address N1: </span> {{$station->IpAddr1}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Ip Address N2: </span> {{$station->IpAddr2}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Ip Address N3: </span> {{$station->IpAddr3}}</li>
            @endif
            <x-detailsitem>
              <x-detailsspan>
                Status:
              </x-detailsspan>
              @php
              if($station->state !== 1){
              $ip = $station->mainIpAddr;
              // $ping = exec('ping -n 1 -w 1000 '.$ip, $output, $status);
              // remove this
              $status = 1;
              if($status == 1){
                  echo  '<i class="fa-solid fa-circle w-2/12 text-xs text-red-600 text-right">offline</i>';
              }elseif ($status == 0) {
                  echo  '<i class="fa-solid fa-circle  w-2/12 text-xs text-green-500 text-right">Live</i>';
              }else{
                echo  '<i class="fa-solid fa-circle  w-2/12 text-xs text-orange-500 text-right">Error</i>';
              }
            }
              @endphp
              </x-detailsitem>
            @if(!is_null($station->switch))
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Switch: </span> {{$switch->switchName}}</li>
            @endif
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Port: </span> @if (!$station->port)there's no port @endif{{$station->port}}</li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Description: </span> @if (!$station->description)there's no description @else {{$station->description}} @endif</li>
              <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Link: </span> @if (!$station->link)there's no embedded link @else <a href="{{$station->link}}"  target="_blank" class="text-blue-700"> {{$station->link}} </a>@endif</li>
        </ul>
      </div>
    </div>

    <div class="w-10/12 md:w-6/12 mb-10 lg:w-4/12 px-12 md:px-4 mr-auto ml-auto -mt-78">
      <div class="relative flex flex-col min-w-0  w-full mb-6rounded-lg">
            <div class="px-4 py flex-auto">
              <h6 class="text-xl mb-1 font-semibold">About connected switch</h6>
              <ul class="border border-gray-200 rounded overflow-hidden shadow-md text-left">
                @if (isset($switch) && isset($cabinet))
                <x-detailsitem>
                  <x-detailsspan>
                    Cabinet name:
                  </x-detailsspan>
                  {{$cabinet->name}}
                </x-detailsitem>
                {{--  --}}
                <x-detailsitem>
                  <x-detailsspan>
                    Cabinet zone:
                  </x-detailsspan>
                  {{$cabinet->zone}}
                </x-detailsitem>
                {{--  --}}
                <x-detailsitem>
                  <x-detailsspan>
                    Switch ip address:
                  </x-detailsspan>
                  {{$switch->ipAddr}}
                </x-detailsitem>
                {{--  --}}
                <x-detailsitem>
                  <x-detailsspan>
                    Switch number of ports:
                  </x-detailsspan>
                  {{$switch->portsNum}}
                </x-detailsitem>
                @else
                <x-detailsitem>
                  <x-detailsspan>
                    There's no switch / cabinet
                  </x-detailsspan>
                </x-detailsitem>
                @endif
            </ul>
        </div>
      <div class="py-5 flex-auto ">
            <div class="text-blueGray-500 p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-white">
              <i class="fas fa-sitemap"></i>
            </div>
          <h6 class="text-xl mb-1 font-semibold">
            Connected Equipments
          </h6>
          <div class="relative flex flex-col mt-4  h-56 overflow-auto">
            <div class="px-4 py-5 flex-auto">
              <ul class="border border-gray-200 rounded shadow-md text-left">
                @if ($equipments == '')
                <li>there are no equipments</li>
                @else
                @if(session()->get('username'))
                  <li onclick="location.href='/equipment/{{$station->SN}}'" class="flex px-4 py-3 border-b last:border-none border-gray-200 hover:bg-gray-200 text-gray-500 transition-all duration-300 ease-in-out cursor-pointer">
                    &#x2b; Add a new equipment
                  </li>
                @endif
                @foreach ($equipments as $equipment)
                @php
                $type = $eqtype->where('name', '=', $equipment->type);
                @endphp
                <li class="flex px-4 py-3 border-b last:border-none border-gray-200 hover:bg-gray-200 text-gray-500 transition-all duration-300 ease-in-out cursor-pointer" data-modal-toggle="{{$equipment->name}}modal">
                  <img class="w-14 h-14 rounded-full" src="/assets/images/equipments/{{$type[$type->keys()[0]]->icon}}">
                  <div class="block">
                    {{$equipment->name}}
                    <div class="flex items-center text-gray-400">
                        {{$equipment->type}}
                        @if($equipment->IpAddr)
                          {{$equipment->IpAddr}}
                          @php
                          if($equipment->state == 1){
                          $ip = $equipment->IpAddr;
                          // $ping = exec('ping -n 1 -w 1000 '.$ip, $output, $status);
                          // remove this
                          $status = 1;
                          if($status == 1){
                            echo  '<i class="fa-solid fa-circle w-1/12 m-5 text-xs text-red-600"></i>';
                          }elseif ($status == 0) {
                            echo  '<i class="fa-solid fa-circle w-1/12 m-5 text-xs text-green-500"></i>';
                          }else{
                              echo  '<i class="fa-solid fa-circle  w-1/12 m-5 text-xs text-orange-500"></i>';
                            }
                          }
                          @endphp
                        @endif
                    </div>
                  </div>
                  </li>
                  {{-- -------------------------------------modal------------------------------------------------------------------------- --}}
                  <div id="{{$equipment->name}}modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                      <!-- Modal content -->
                      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                          <!-- Modal header -->
                          <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                              Details of {{$equipment->name}}
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="{{$equipment->name}}modal">
                              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                              <span class="sr-only">Close modal</span>
                            </button>
                          </div>
                              <!-- Modal body -->
                              <div class="p-6 space-y-6 flex items-center">
                                  <img class="w-28 h-28 rounded-full" src="/assets/images/equipments/{{$type[$type->keys()[0]]->icon}}">
                                  <div class="px-4 flex-auto">
                                    <ul class="rounded overflow-hidden shadow-md text-left">
                                      @if (isset($equipment))
                                      <x-detailsitem>
                                        <x-detailsspan>
                                          Equipment name:
                                        </x-detailsspan>
                                        {{$equipment->name}}
                                        </x-detailsitem>
                                        {{--  --}}
                                      <x-detailsitem>
                                        <x-detailsspan>
                                          Equipment serial number:
                                        </x-detailsspan>
                                        {{$equipment->SN}}
                                        </x-detailsitem>
                                        {{--  --}}
                                      <x-detailsitem>
                                        <x-detailsspan>
                                          Equipment type:
                                        </x-detailsspan>
                                        {{$equipment->type}}
                                        </x-detailsitem>
                                        {{--  --}}
                                      <x-detailsitem>
                                        <x-detailsspan>
                                          Equipment supplier:
                                        </x-detailsspan>
                                        {{$equipment->supplier}}
                                        </x-detailsitem>
                                        {{--  --}}
                                      <x-detailsitem>
                                        <x-detailsspan>
                                          Equipment ip address:
                                        </x-detailsspan>
                                        @if($equipment->IpAddr =='')
                                          This item doesn't have an ip address
                                        @else
                                        {{$equipment->IpAddr}}
                                        @endif
                                        </x-detailsitem>
                                        {{--  --}}
                                      <x-detailsitem>
                                        <x-detailsspan>
                                          Connected port:
                                        </x-detailsspan>
                                        {{$equipment->port}}
                                        </x-detailsitem>
                                        {{--  --}}
                                      <x-detailsitem>
                                        <x-detailsspan>
                                          description:
                                        </x-detailsspan>
                                        @if($equipment->description =='')
                                          there's no description
                                        @else
                                        {{$equipment->description}}
                                        @endif
                                        </x-detailsitem>
                                      @else
                                      <li class="px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">There's no switch / cabinet </span></li>
                                      @endif
                                  </ul>
                              </div>
                          </div>
                          {{-- <!-- Modal footer -->
                          <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                              <button data-modal-toggle="{{$equipment->name}}modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">hide details</button>
                          </div> --}}
                      </div>
                    </div>
                </div>
                {{-- -------------------------------------modal------------------------------------------------------------------------- --}}
                  @endforeach
                @endif
              </ul>
            </div>
          </div>
          </div>
    </div>
  </div>
</div>
</div>

</section>
{{-- ==================== --}}
@if (session()->get("loggedIn"))
  

<div class="block lg:flex">
  <div class="list-none flex flex-col min-w-0 max-w-full lg:w-4/5 h-fit mb-6 shadow-lg rounded-lg bg-white">
    <div class="flex items-center bg-gray-200">
      <span class=" font-bold text-xl text-center m-auto p-3 w-full">PLC data</span>
      <button class="self-end  border-2 border-black rounded-md" onclick="readAllData()">
        <x-faRefresh/>
      </button>
    </div>
    <div class="flex justify-evenly">
      <div class="w-full">
        <h2 class="text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">User Variables</h2>
        <div id="accordion">
        </div>
      </div>
      @if ($loggedIn && $role!=="USER1")
      <x-table :headers="['Variable Name', 'Current Value', 'Options']" id="modelVariablesTable" caption="Model variables"/>
      <x-table :headers="['Variable Name', 'Current Value', 'Options']" id="otherVariablesTable" caption="Other variables"/>
      @else
      <x-table :headers="['Variable Name', 'Current Value']" id="modelVariablesTable" caption="Model variables"/>
      <x-table :headers="['Variable Name', 'Current Value']" id="otherVariablesTable" caption="Other variables"/>
      @endif
    </div>
  </div>
  
  @if ($loggedIn && $role!=="USER1")
  <div class="list-none flex lg:flex-col min-w-0  w-full lg:w-1/5 h-fit mb-6 shadow-lg rounded-lg bg-gray-300">
    <span class="bg-gray-200 font-bold text-xl text-center m-auto p-3 w-full">PLC Controls</span>
    <x-selectVariable :token="$token" :stationid="$stationId"/>
    <x-selectUser :token="$token" :stationid="$stationId"/>
    <x-createPrototype :token="$token" :stationid="$stationId"/>
    <x-usePrototype :token="$token" :stationid="$stationId" :prototypes="$prototypes"/>
    @if ($loggedIn && $role==="ADMIN")
    <x-eraseDb :token="$token" :stationid="$stationId"/>
    @endif
  </div>
  @endif
</div>
{{-- ==================== --}}
<script>
  const stationId = '{{$stationId}}'; // Replace with your actual station ID
  function handleEditClick(id){
    if('{{$role}}' !== 'USER1'){
        var baseUrl = "{{ route('variable.data', ['id' => 'PLACEHOLDER']) }}";
        var finalUrl = baseUrl.replace('PLACEHOLDER', id);
        window.location.href = finalUrl;
    }
  }
  function handleDeleteClick(id){
    if('{{$role}}' !== 'USER1'){
      if(confirm("Are you sure you want to delete this variable?")){
        $.ajax({
          url: `http://172.30.125.81:8080/api/v1/variables/delete/${id}`,
          type: 'DELETE', 
          headers: {
              'Authorization': `Bearer ${"{{$token}}"}`
          },
          success: function (response) {
            alert('Variable hidden successfully!');
            $(`#item-${id}`).remove();
          },
        })
      }
    }
  }
  @if ($loggedIn && $role==="ADMIN")
  function handleEditValueClick(id){
    let newValue = prompt("Please enter the new value (this will change the actual plc value, BE CAREFUL!!)");
    if (newValue == null || newValue == ""){
      e.preventDefault(); // Prevent the default form submission
      $.ajax({
        url: `http://172.30.125.81:8080/api/v1/variables/current_value_changing/${id}`,
        type: 'PATCH',
        headers: {
          'Authorization': `Bearer ${"{{$token}}"}`
        },
        data: { newValue: newValue },
      });
    }
  }
  @endif
  function fillTables(data, table){
    const tbody = table.find('tbody');
    tbody.empty();
    data.forEach(variable => {
      const row = `<tr id="item-${variable.variableId}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
          <td class="px-6 py-4">${variable.variableName}</td>
          <td class="px-6 py-4" id="value-${variable.variableId}">${variable.currentValue}</td>
          @if ($loggedIn && $role!=="USER1")
          <td class="px-6 py-4 flex">
            <button onclick="handleEditClick(${variable.variableId})">
              <x-faChange/>
            </button>
            <button onclick="handleDeleteClick(${variable.variableId})">
              <x-faDelete/>
            </button>
            @if ($loggedIn && $role==="ADMIN")
            <button onclick="handleEditValueClick(${variable.variableId})">
              <x-faEdit/>
            </button>
            @endif
          </td>
          @endif
      </tr>`;
      tbody.append(row);
    });
  }

  function fillAccordion(data, accordion){
    
    accordion.empty();
    data.forEach((group, index) => {
      let id = index+1;
      let accordionHtml = `
        <h2>
          <button type="button" class="flex items-center justify-evenly w-full px-24 py-2 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3">
            <span>${group[0].currentValue}</span>
            <svg class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
          </button>
        </h2>
        <div>
          <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            <div class="relative overflow-x-auto">
              <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th>Name</th>
                    <th>Value</th>
                     @if ($loggedIn && $role!=="USER1")
                    <th>Options</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  <tr class="mb-2">
                    <td>name</td>
                    <td>${group[0].currentValue}</td>
                    @if ($loggedIn && $role!=="USER1")
                    <td>
                      <button onclick="handleEditClick(${group[0].variableId})">
                        <x-faChange/>
                      </button>
                      <button onclick="handleDeleteClick(${group[0].variableId})">
                        <x-faDelete/>
                      </button>
                      @if ($loggedIn && $role==="ADMIN")
                      <button onclick="handleEditValueClick(${group[0].variableId})">
                        <x-faEdit/>
                      </button>
                      @endif
                    </td>
                    @endif
                  </tr>
                  ${group.slice(1).map(item => `
                      <tr class="mb-2">
                        <td class="text-gray-500 dark:text-gray-400">${item.variableName.split(" ")[1]}</td>
                        <td>${item.currentValue}</td>
                        @if ($loggedIn && $role!=="USER1")
                        <td>
                          <button onclick="handleEditClick(${item.variableId})">
                            <x-faChange/>
                          </button>
                          <button onclick="handleDeleteClick(${item.variableId})">
                            <x-faDelete/>
                          </button>
                          @if ($loggedIn && $role==="ADMIN")
                          <button onclick="handleEditValueClick(${item.variableId})">
                            <x-faEdit/>
                          </button>
                          @endif
                        </td>
                        @endif
                      </tr>
                    `).join('')}
                </tbody>
              </table>
            </div>
          </div>
        </div>`;
      accordion.append(accordionHtml);
    });
    $( function() {
      $( "#accordion" ).accordion({
        collapsible: true,
        active: false
      });
    } );
  }

  function groupItemsByVariableName(items){
    let groupedData = {};
    
    // Function to extract base identifier from variableName
    function extractBaseName(variableName) {
        // Split the variable name by spaces and take the first part as the base
        return variableName.split(' ')[0];
    }

    // Iterate through the items and group them by their base name
    items.forEach(item => {
        const baseName = extractBaseName(item.variableName);
        
        if (!groupedData[baseName]) {
            groupedData[baseName] = [];
        }

        groupedData[baseName].push(item);
    });

    // Convert the grouped data object to an array
    let groupedDataArray = Object.values(groupedData);

    return groupedDataArray;
  }
  
  function filterAndSortData(data, offset){
    return data
    .filter(item => [offset].includes(item.dbNumber))
    .sort((a, b) => {
        if (a.varOffset < b.varOffset) return -1;
        if (a.varOffset > b.varOffset) return 1;
        if (a.dbNumber < b.dbNumber) return -1;
        if (a.dbNumber > b.dbNumber) return 1;
        return 0;
    });
  }
  function patchData(stationId){
    $.ajax({
        url: `http://172.30.125.81:8080/api/v1/stations/read/{{$stationId}}`,
        type: 'PATCH', // Use PATCH method
        headers: {
            'Authorization': `Bearer ${"{{$token}}"}`
        },
        contentType: 'application/json',
    });
  }
  const userAccordion = $('#accordion');
  const modelTable = $('#modelVariablesTable');
  const otherTable = $('#otherVariablesTable');
  function fetchData(stationId){
        $.ajax({
          url: `http://172.30.125.81:8080/api/v1/stations/${stationId}/variables`,
          type: 'GET',
          headers: {
              'Authorization': `Bearer ${"{{$token}}"}`
          },
          dataType: 'json',
          success: function(data) {
            if('{{$role}}'=="USER1"){
              data = data.filter(variable => !variable.strict_Access);
            }
            // data filtration based on db
            patchData(stationId);
            modelVariableData = filterAndSortData(data, 9007);
            otherVariableData = filterAndSortData(data, 105);
            userVariablesData = filterAndSortData(data, 3032);
            let groupedUserData = groupItemsByVariableName(userVariablesData);
            fillAccordion(groupedUserData, userAccordion);
            fillTables(modelVariableData, modelTable)
            fillTables(otherVariableData, otherTable)
          },
          error: function(xhr, status, error) {
              console.error('Failed to fetch data:', error);
              alert('Something went wrong, either this station doesn\'t have a plc connected or you\'re not logged in');
          }
      });
  }

  function readAllData(){
    $( "#accordion" ).accordion( "destroy" );
    fetchData(stationId);
  }
  
  // $(document).ready(function() {
    fetchData(stationId);
  // });
</script>
@endif
</x-app-layout>
<x-app-layout>
    @section('title', 'Layout | PLC logs')
    <x-button id="start" onclick="startTracking()">
        Start Tracking
    </x-button>
    <x-button id="stop" onclick="stopTracking()">
        Stop Tracking
    </x-button>
    <x-table :headers="['Variable', 'Station', 'Value', 'Time']" id="records" caption=""/>
    <script>
    // Define your functions in the global scope
    function startTracking() {
        let id = "{{ $id }}";
        $.ajax({
            url: `http://varmoxan18:2024/api/v1/data_records/start-tracking/${id}`,
            type: 'POST',
            headers: {
                'Authorization': `Bearer ${"{{$token}}"}`
            },
            success: function(data) {
                console.log('Tracking started');
            },
            error: function(xhr, status, error) {
                console.error('An error occurred:', error);
            }
        });
    }

    function stopTracking() {
        let id = "{{ $id }}";
        $.ajax({
            url: `http://varmoxan18:2024/api/v1/data_records/stop-tracking/${id}`,
            type: 'POST',
            headers: {
                'Authorization': `Bearer ${"{{$token}}"}`
            },
            success: function(data) {
                console.log('Tracking Stopped');
            },
            error: function(xhr, status, error) {
                console.error('An error occurred:', error);
            }
        });
    }

    function fetchData() {
        let startDate = "{{$startDate}}";
        let endDate = "{{$endDate}}"; 
        let id = "{{$id}}";
        const table = $('#records');
        const tbody = table.find('tbody');
        tbody.empty();
        $.ajax({
            url: `http://varmoxan18:2024/api/v1/lines/${id}/records-summary?startDate=${startDate}&endDate=${endDate}`,
            type: 'GET',
            headers: {
                'Authorization': `Bearer ${"{{$token}}"}`
            },
            dataType: 'json',
            success: function(data) {
                data.forEach(variable => {
                    const row = `<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">${variable.variableName}</td>
                        <td class="px-6 py-4">${variable.variableStationName}</td>
                        <td class="px-6 py-4">${variable.variableValue}</td>
                        <td class="px-6 py-4">${new Date(variable.currentTime).toLocaleString()}</td>
                    </tr>`;
                    tbody.append(row);
                });
                console.log('Data successfully fetched:', data);
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch data:', error);
            }
        });
    }

    $(document).ready(function() {
        setInterval(fetchData, 22000);
    });
    </script>
</x-app-layout>

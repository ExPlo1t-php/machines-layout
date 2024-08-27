<x-app-layout>
    @section('title', 'Layout | PLC Records')
    <div class="w-1/2 flex  justify-between">
        <div class="flex items-center">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="startDate">
                Start Date
            </label>
            <input
                type="date"
                id="startDate"
                name="startDate"
                placeholder="Start Date"
            />
        </div>
        <div class="flex items-center">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="endDate">
                End Date
            </label>
            <input
            type="date"
            id="endDate"
            name="endDate"
            placeholder="End Date"
            />
        </div>
    </div>
    <x-table :headers="['Id','Line name', 'Action']" id="lines-table" caption="Lines"/>
    <script>
        let startDate = $("#startDate").val(new Date().toISOString().split('T')[0]).val();
        let endDate = $("#endDate").val("2200-01-01").val();
        // Update variables when the start date changes
        $("#startDate").on("change", function() {
        startDate = $(this).val();
        console.log("Start Date changed to:", startDate); // Debug log
        });

        // Update variables when the end date changes
        $("#endDate").on("change", function() {
        endDate = $(this).val();
        console.log("End Date changed to:", endDate); // Debug log
        });

        function viewRecords(id){
            window.location.href = `/traceability/${id}?startDate=${startDate}&endDate=${endDate}`
        }


        const linesTable = $('#lines-table');
        function fillTable(data, table){
            const tbody = table.find('tbody');
            tbody.empty();
            data.forEach(variable => {
            const row = `<tr id="item-${variable.lineId}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4" id="value-${variable.lineId}">${variable.lineId}</td>
                <td class="px-6 py-4">${variable.lineName}</td>
                <td class="px-6 py-4 flex">
                    <button onclick="viewRecords(${variable.lineId})" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        View Records
                    </button>
                </td>
            </tr>`;
            tbody.append(row);
            });
        }
        $(document).ready(function(){
            $.ajax({
                url: `http://172.30.125.81:8080/api/v1/lines`,
                type: 'GET',
                headers: {
                    'Authorization': `Bearer ${"{{$token}}"}`
                },
                dataType: 'json',
                success: function(data) {
                    fillTable(data, linesTable)
                    console.log('Data successfully fetched:', data);
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch data:', error);
                }
            });


        });
    </script>
</x-app-layout>
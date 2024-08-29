<!-- modal toggle -->
<button data-modal-target="eraseDb" data-modal-toggle="eraseDb" class="block text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm mx-5 my-3 px-5 py-2.5 text-center" type="button">
    Erase DB
</button>
  
  <!-- modal -->
  <div id="eraseDb" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Erase DB
                  </h3>
                  <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="eraseDb">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!--  Modal body  -->
              <div class="p-4 md:p-5">
                  <form id="eraseDbForm" class="space-y-4" action="#">
                    <x-formInput>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="dbNumberErase">
                            DB Number
                        </label>
                        <input name="dbNumberErase" min="0"  id="dbNumberErase" type="number" placeholder="DB Number" required class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 appearance-none">
                    </x-formInput>
                    <x-formInput>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="confirmationInput">
                            Type CONFIRM to Submit
                        </label>
                        <input name="confirmationInput" required class="appearance-none block w-full text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="confirmationInput" type="text" placeholder="Type CONFIRM">
                    </x-formInput>
                    {{--  --}}
                    <div class="flex justify-center">
                        <button type="submit" id="submitForm" class="bg-red-800 hover:bg-red-700 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                            Submit
                        </button>
                        <button type="button" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow" data-modal-toggle="eraseDb">
                            Cancel
                        </button>
                    </div>
                  </form>
              </div>
          </div>
      </div>
  </div> 
<script>
$('#eraseDbForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission
    let dbNumberValue = $('#dbNumberErase').val();
    let confirmationValue = $('#confirmationInput').val();
    if (confirmationValue == 'CONFIRM'){
        $.ajax({
            url: `http://varmoxan18:2024/api/v1/stations/{{$stationid}}/eraseDbData`,
            type: 'POST',
            headers: {
                'Authorization': `Bearer ${"{{$token}}"}`
            },
            data: {
                dbNumber: dbNumberValue,
            },
            contentType: 'application/json', // Ensure that the request is sent as JSON
            success: function (response) {
                alert('Form submitted successfully!');
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert('An error occurred while submitting the form.');
            }
        });
    } else {
        e.preventDefault(); 
        alert('Please type "CONFIRM" to proceed.');
    }
});

</script>
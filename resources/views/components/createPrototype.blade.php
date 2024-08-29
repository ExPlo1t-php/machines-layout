<!-- modal toggle -->
<button data-modal-target="createProtoype" data-modal-toggle="createProtoype" class="block text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm mx-5 my-3 px-5 py-2.5 text-center" type="button">
    Create prototype
</button>
  
  <!-- modal -->
  <div id="createProtoype" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Create prototype
                  </h3>
                  <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="createProtoype">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!--  Modal body  -->
              <div class="p-4 md:p-5">
                  <form id="prototypeForm" class="space-y-4" action="#">
                    <x-formInput>
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="prototypeName">
                        Prototype name
                      </label>
                      <input name="prototypeName" required class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="prototypeName" type="text" placeholder="prototype Name">
                    </x-formInput>
                    {{--  --}}
                    <div class="flex justify-center">
                        <button type="submit" id="submitForm" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                            Submit
                        </button>
                    </div>
                  </form>
              </div>
          </div>
      </div>
  </div> 
<script>
$('#prototypeForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    let formData = {
        prototypeName: $('#prototypeName').val(),
    };

    $.ajax({
        url: `http://varmoxan18:2024/api/v1/prototypes/create/{{$stationid}}`,
        type: 'POST',
        headers: {
            'Authorization': `Bearer ${"{{$token}}"}`
        },
        contentType: 'application/json', // Ensure that the request is sent as JSON
        data: JSON.stringify(formData),  // Convert form data to JSON string
        success: function (response) {
            console.log(response);
            alert('Form submitted successfully!');
        },
        error: function (xhr, status, error) {
            console.error(error);
            alert('An error occurred while submitting the form.');
        }
    });
});

</script>
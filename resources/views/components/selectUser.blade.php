<!-- Select user toggle -->
<button data-modal-target="selectUser" data-modal-toggle="selectUser" class="block text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm mx-5 my-3 px-5 py-2.5 text-center" type="button">
    Show user
</button>
  
  <!-- Select user modal -->
  <div id="selectUser" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Select user Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Select a User to show
                  </h3>
                  <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="selectUser">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Show user Modal body ############################################################################################################################# -->
              <div class="p-4 md:p-5">
                  <form id="userForm" class="space-y-4" action="#">
                    <x-formInput>
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="userVariableName">
                        User Name (Display name)
                      </label>
                      <input name="userVariableName" required class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="userVariableName" type="text" placeholder="User Display Name">
                    </x-formInput>
                    {{--  --}}
                    <x-formInput class="none hidden">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="userVariable_type">
                        Variable Type
                      </label>
                      <select name="userVariable_type" required
                       class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="userVariable_type">
                        <option value="BOOL">BOOL</option>
                        <option value="BOOL_COMP">BOOL_COMP</option>
                        <option value="NUMBER">NUMBER</option>
                        <option selected value="STRING_USER">STRING_USER</option>
                        <option value="STRING_MODEL">STRING_MODEL</option>
                        <option value="STRING_COMPONENT">STRING_COMPONENT</option>
                      </select>
                    </x-formInput>
                    {{--  --}}
                    <x-formInput class="hidden">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="userDbNumber">
                          DB Number
                      </label>
                      <input name="userDbNumber" required min="0" value="3032"  id="userDbNumber" type="number" placeholder="DB number" required class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 appearance-none">
                    </x-formInput>
                    {{--  --}}
                    <x-formInput>
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="userVarOffset">
                          Offset
                      </label>
                      <input name="userVarOffset" required min="0"  id="userVarOffset" type="number" placeholder="Variable Offset" required class=" block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 appearance-none">
                    </x-formInput>
                    {{--  --}}
                    <x-formInput class="hidden">
                      <input name="userBitPosition" value="0" min="0"  id="userBitPosition" type="number" placeholder="Bit position" required class="invisible block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 appearance-none">
                    </x-formInput>
                    {{--  --}}
                    <x-formInput>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="user_strict_Access">
                          Strict Access
                        </label>
                        <!-- Hidden input to ensure 'false' is sent when unchecked -->
                        <input type="hidden" name="user_strict_Access" value="false">

                        <!-- Checkbox input -->
                        <input name="user_strict_Access" id="user_strict_Access" type="checkbox" class="appearance-none block text-gray-700 border border-gray-300 rounded py-2 px-2 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

                        <script>
                            $(document).ready(function() {
                                // When the checkbox is checked or unchecked
                                $('#user_strict_Access').change(function() {
                                    if (this.checked) {
                                        $(this).val("true");
                                    } else {
                                        $(this).val("false");
                                    }
                                });
                            });
                        </script>
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
$('#userForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    let formData = {
        variableName: $('#userVariableName').val(),
        variable_type: $('#userVariable_type').val(),  // Assuming grid-password is the select for variable type
        dbNumber: $('#userDbNumber').val(),
        varOffset: $('#userVarOffset').val(),
        bitPosition: $('#userBitPosition').val(),
        strict_Access: $('#user_strict_Access').is(':checked') // true if checked, false if unchecked
    };

    console.log(stationId);

    $.ajax({
        url: `http://varmoxan18:2024/api/v1/stations/{{$stationid}}/createplcuser`,
        type: 'POST',
        headers: {
            'Authorization': `Bearer ${"{{$token}}"}`
        },
        contentType: 'application/json', // Ensure that the request is sent as JSON
        data: JSON.stringify(formData),  // Convert form data to JSON string
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.error(error);
            alert('An error occurred while submitting the form.');
        }
    });
});

</script>
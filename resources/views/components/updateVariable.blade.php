@section('title', 'Layout | Edit variable')
@extends('dashboard')

@section('component')
    <form id="variableForm" class="w-full max-w-lg flex-col self-center" action="#">
        <x-formInput>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="variableName">
                Variable Name
            </label>
            <input name="variableName" required class="appearance-none block w-full text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="variableName" type="text" placeholder="Variable Name">
        </x-formInput>
        <x-formInput>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="variable_type">
                Variable Type
            </label>
            <select name="variable_type" required class="appearance-none block w-full text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="variable_type">
                <option selected value="BOOL">BOOL</option>
                <option value="BOOL_COMP">BOOL_COMP</option>
                <option value="NUMBER">NUMBER</option>
                <option value="STRING_USER">STRING_USER</option>
                <option value="STRING_MODEL">STRING_MODEL</option>
                <option value="STRING_COMPONENT">STRING_COMPONENT</option>
            </select>
        </x-formInput>
        <x-formInput>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="dbNumber">
                DB Number
            </label>
            <input name="dbNumber" required min="0" id="dbNumber" type="number" placeholder="DB number" class="appearance-none block w-full text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        </x-formInput>
        <x-formInput>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="varOffset">
                Offset
            </label>
            <input name="varOffset" required min="0" id="varOffset" type="number" placeholder="Variable Offset" class="appearance-none block w-full text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        </x-formInput>
        <x-formInput>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="bitPosition">
                Bit position
            </label>
            <input name="bitPosition" required min="0" id="bitPosition" type="number" placeholder="Bit position" class="appearance-none block w-full text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        </x-formInput>
        <x-formInput>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                Strict Access
            </label>
            <!-- Hidden input to ensure 'false' is sent when unchecked -->
            <input type="hidden" name="strict_Access" value="false">

            <!-- Checkbox input -->
            <input name="strict_Access" id="strict_Access" type="checkbox" class="appearance-none block text-gray-700 border border-gray-300 rounded py-2 px-2 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            <script>
                $(document).ready(function() {
                    // When the checkbox is checked or unchecked
                    $('#strict_Access').change(function() {
                        if (this.checked) {
                            $(this).val("true");
                        } else {
                            $(this).val("false");
                        }
                    });
                });
            </script>
        </x-formInput>
        <div class="flex justify-center">
            <button type="submit" id="submitForm" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                Submit
            </button>
        </div>
    </form>

<script>
$(document).ready(function () {
    var data = @json($data);
    $('#variableName').val(data.variableName);
    $('#variable_type').val(data.variable_type);
    $('#dbNumber').val(data.dbNumber);
    $('#varOffset').val(data.varOffset);
    $('#bitPosition').val(data.bitPosition);
    $('#strict_Access').prop('checked', data.strict_Access);

    const variableId = data.variableId; 
    $('#variableForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        let formData = {
            variableName: $('#variableName').val(),
            variable_type: $('#variable_type').val(), 
            dbNumber: $('#dbNumber').val(),
            varOffset: $('#varOffset').val(),
            bitPosition: $('#bitPosition').val(),
            strict_Access: $('#strict_Access').is(':checked') // true if checked, false if unchecked
        };


        $.ajax({
            url: `http://172.30.125.81:8080/api/v1/variables/update/${variableId}`,
            type: 'PATCH', 
            headers: {
                'Authorization': `Bearer ${"{{$token}}"}`
            },
            contentType: 'application/json', // Ensure that the request is sent as JSON
            data: JSON.stringify(formData),  // Convert form data to JSON string
            success: function (response) {
                console.log(response);
                window.history.back();
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert('An error occurred while updating the variable.');
            }
        });
    });
});
</script>
@endsection

     <x-app-layout>
            <div class="w-full md:w-6/12 px-4">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <section class="relative pt-13 bg-blueGray-50 max-h-screen bg-gray-100">
                    <div class="container mx-4">
                      <div class="flex flex-wrap w-screen content-between items-center">
                        <!-- Your existing content -->
                        <div class="w-full md:w-6/12 px-4">
                          <button id="fetchDataButton">Fetch Data from API</button>
                          <div id="apiData"></div>
                        </div>
                      </div>
                    </div>
                  </section>
          </div>
          <script>
            // ///////////////////////////////////////////////////////
            $(document).ready(function() {
              $('#fetchDataButton').on('click', function() {
               // Set up the AJAX CSRF token
                $.ajaxSetup({
                    headers: {
                        'XSRF-TOKEN': '$('meta[name="csrf-token"]').attr('content')'
                    }
                });

                $.ajax({
                    url: 'http://localhost:9898/login',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        name: 'admin',
                        password: 'adminusus',
                        remember: false
                    }),
                    success: function (response, status, jqXHR) {
                        console.log('Success:', response);

                        // Capture response headers
                        var allHeaders = jqXHR.getAllResponseHeaders();
                        console.log('All Headers:', allHeaders);

                        var specificHeader = jqXHR.getResponseHeader('Content-Type');
                        console.log('Content-Type Header:', specificHeader);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    }
                });


                // Send the AJAX request to the external API
                // $.ajax({
                //   url: 'http://localhost:9898/gett', // Replace with the external API URL
                //   type: 'GET',
                //   success: function(response) {
                //     // Handle success response
                //     $('#Data').html(response);
                //   },
                //   error: function(xhr, status, error) {
                //     // Handle error response
                //     $('#apiData').html('<p>An error occurred: ' + error + '</p>');
                //   }
                // });
              });
          
            });
          </script>
    </x-app-layout> 
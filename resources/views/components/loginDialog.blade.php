<script>
    $( function() {
      var dialog, form,
   
        // From https://html.spec.whatwg.org/multipage/input.html#e-mail-state-%28type=email%29
        emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
        email = $( "#email" ),
        password = $( "#password" ),
        allFields = $( [] ).add( name ).add( email ).add( password ),
        tips = $( ".validateTips" );
   
      function updateTips( t ) {
        tips
          .text( t )
          .addClass( "ui-state-highlight" );
        setTimeout(function() {
          tips.removeClass( "ui-state-highlight", 1500 );
        }, 500 );
      }
   
      function checkLength( o, n, min, max ) {
        if ( o.val().length > max || o.val().length < min ) {
          o.addClass( "ui-state-error" );
          updateTips( "Length of " + n + " must be between " +
            min + " and " + max + "." );
          return false;
        } else {
          return true;
        }
      }
   
      function checkRegexp( o, regexp, n ) {
        if ( !( regexp.test( o.val() ) ) ) {
          o.addClass( "ui-state-error" );
          updateTips( n );
          return false;
        } else {
          return true;
        }
      }
   
      function plcLogin() {
        var valid = true;
        allFields.removeClass( "ui-state-error" );
   
        valid = valid && checkLength( email, "email", 6, 80 );
   
        valid = valid && checkRegexp( email, emailRegex, "eg. user@opm.com" );
        if (valid) {
        var formData = {
            email: $('#email').val(),
            password: $('#password').val(),
            _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token for Laravel
        };

        // Send AJAX request to the Laravel controller
        $.ajax({
            url: '/plc/login', // Replace with your actual route
            type: 'POST',
            data: formData,
            success: function(response) {
                location.reload();
                console.log(response.data); // Debugging: Check returned data
            },
            error: function(xhr) {
                console.log(xhr.responseJSON.error); // Debugging: Check error details
            }
        });
    }
        return valid;
      }
   
      dialog = $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 335,
        width: 400,
        modal: true,
        buttons: {
          "Login to PLC tracking": plcLogin,
          Cancel: function() {
            dialog.dialog( "close" );
          }
        },
        close: function() {
          form[ 0 ].reset();
          allFields.removeClass( "ui-state-error" );
        }
      });
   
      form = dialog.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        plcLogin();
      });
   
      $( "#show-form" ).button().on( "click", function() {
        dialog.dialog( "open" );
      });
      $( "#plc-logout" ).button().on( "click", function() {
        $.ajax({
            url: '/plc/logout', 
            type: 'GET',
            success: function(response) {
                console.log(response.data); // Debugging: Check returned data
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseJSON.error); // Debugging: Check error details
            }
        });
      });
    } );
    </script>
        @if (!$status) 
        <div id="dialog-form" class="relative bg-white rounded-lg shadow dark:bg-gray-700" title="Create new user">
            <p class="validateTips">All form fields are required.</p>
            
            <form class="w-full max-w-lg flex-col self-center justify-between" method="POST" action="/plc/login">
                <label for="email" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Email</label>
                <input type="text" name="email" id="email" class="ui-widget-content ui-corner-all appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <label for="password" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Password</label>
                <input type="password" name="password" id="password" class="ui-widget-content ui-corner-all appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                
                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </form>
        </div>
        <button id="show-form" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Login to PLC</button>
        @else
        <button id="plc-logout" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Logout of PLC</button>
        @endif
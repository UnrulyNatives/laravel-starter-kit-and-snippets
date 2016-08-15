(function($) {
    $('#unhideInterfaceSetter a[data-remote=true]').on('ajax:beforeSend', function(xhr, settings) {
        $('#unhideInterfaceSetter .dropdown-toggle').click();
    });
    $('#unhideInterfaceSetter a[data-remote=true]').on('ajax:success', function(xhr, data, status) {
        $('#interface_update').text(data.interface_update);
    });
    /* now intercepted by global body handler
        $('#baseCountrySetter a[data-remote=true]').on('ajax:error', function(xhr, status, error) {
            alert(error); // przydałoby się coś ładniejszego
        });
    */
})(jQuery);



            $(document).ready(function() {
                /*//  */
                $('#choice_-1').toggleClass('red4');

                var choice = $('#test').attr("data-choice");
                // $('#choice_1').text(choice);

                if (choice == "-1") {
                    $('#choice_-1').toggleClass('red');
                    $('#choice_-1').toggleClass('csh_12');
                };
                if (choice == "0") {
                    $('#choice_ALL').toggleClass('red');
                    $('#choice_ALL').toggleClass('csh_12');
                };

            });


                /* animating icon in off-canvas toolbox */
                $( ".ca" ).hover(function() {
                // $( ".ca" ).append( "<div>Handler for .mouseover() called.</div>" );
                $( "#ca-icon" ).toggleClass( "blink_me" );
                });
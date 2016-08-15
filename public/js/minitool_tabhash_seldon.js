        $(document).ready(function () {


            // getting hash value from URL
            var hash = window.location.hash.substr(1);
            var defhash = $('#tab-nav').attr('data-default-tab');
            //identyfying the tab number to be active
            // $('#peter').text(hash);

            // setting a dafault tab if no hash in URL
            // setting a dafault tab if erroneus hash in URL
            if(hash == '' || hash == 'undefined'  ) {
                 var hash = $('#tab-nav').attr('data-default-tab');
                 window.location.hash = $('#tab-nav').attr('data-default-tab');
            }
            console.log(hash);
            console.log(defhash);
            // var dt_number = $('#tab-nav > a#' + hash).data('tab');
            // testy
            // $('.test')   .text(dt_number);
            // $('.test')   .text(hash + ' hs-dt '+dt_number);
            // $('.test')   .addClass('csh_10');

            // activating tabbar element
            // $('#' + hash)   .removeClass('active');
            $('a[href="#' + hash + '"]')   .addClass('active');
            $('a:has([href="#' + hash + '"])')   .attr('aria-expanded','true');

            // activating content
            $('.tab-pane')   .removeClass('active');
            $('.tab-pane#' + hash)   .addClass('active');

            // finally initializing the tab menu
            // $('#tab-nav .item')   .tab();

        });

        // syncs the  url to state of nav tabs
        $('#tab-nav > a').click(function(event) {
            // event.preventDefault();
            window.location.hash = $(this).attr('data-tab');
        });
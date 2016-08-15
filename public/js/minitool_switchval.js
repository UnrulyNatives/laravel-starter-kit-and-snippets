// ajax-load append as first in an element


$('body').on('click', '[data-switchval]', function() {
    var st_value = $(this).data("switchval") ;
    var target = $(this).data("puthere");
    var log_target = $(this).data("log-puthere");
    var descr = $(this).data("name");
    var datafield = $(this).data("field");
    // http://stackoverflow.com/a/1318091/4209866

            $(target).attr('data-' + datafield, st_value);
            $(log_target).attr('data-' + datafield, st_value);
            $(log_target).text(descr);



});
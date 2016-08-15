// ajax-load append as first in an element


$('body').on('click', '[data-append]', function() {
    var lnk = $(this).data("append") + '/' + $(this).data("event") + '/' + $(this).data("question") + '/' + $(this).data("standpoint") + '/' + $(this).data("standpointtype") + '/' + $(this).data("entity");
    var target = $(this).data("appendhere");
    // http://stackoverflow.com/a/1318091/4209866

            $(target).text('moment....');
            $(target).load(lnk);
});
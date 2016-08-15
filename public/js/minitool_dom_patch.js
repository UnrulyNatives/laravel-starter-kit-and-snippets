// ajax-load into an element

$('body').on('click', '[data-load]', function() {
    var lnk = $(this).data("load");
    var target = $(this).data("puthere");
    // http://stackoverflow.com/a/1318091/4209866
    var chunk = $(this).data('chunk');

        // alert('test');

    // removes data-load after first click
    // http://stackoverflow.com/questions/1318076/jquery-hasattr-checking-to-see-if-there-is-an-attribute-on-an-element
    var once = $(this).attr('data-load-once');
    if (typeof once !== typeof undefined && once !== false) {
            $(this).removeAttr("data-load");
    }

    // data-chun attribute specifies an element to be loaded by jQuery, see jQuery `load` function docs
    if (typeof chunk !== typeof undefined && chunk !== false) {
            var lnk = lnk + " " + chunk;
    }
    $(target).text('moment...');
    $(target).load(lnk);


});


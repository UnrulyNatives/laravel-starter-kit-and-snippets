(function($) {
    $('a[data-remote=true]').on('ajax:beforeSend', function(xhr, settings) {
        // $('.ajax_switchboard .dropdown-toggle').click();
    });

    $('a[data-remote=true]').on('ajax:success', function(xhr, data, status) {
        var div = $(this).parent().find('.fa-cog');
        var status = $(this).parent().find('.status');
        div.toggleClass('fa-pulse');
        $(this) . attr('href', data.new_url);
        $(this).toggleClass('un_csch_enabled');
        // $(this).removeClass(data.rem_class);
        // $(this).addClass(data.new_class);
        $(this).text(data.switch_);
        div.toggleClass('fa-pulse');
        div.toggleClass('fa-spin');
        status.toggleClass('opt_active');
        // $('#test').toggleClass('opt_active');
        // $('#test').text(data.test);
    });

})(jQuery);
$('body').on('click', '[data-load-c]', function() {
    var lnk = $(this).data("load-c");
    var target = $(this).data("puthere");
    var x = confirm("Czy na pewno? Pomyśl dwa razy!");
    if (x) {
        $(target).text('moment...');
        $(target).toggleClass('csch_16');
        $(target).load(lnk);
        return true;
    } else {
        $(target).text('ANULOWANO!...');
        return false;
    }
});
$("[data-summon]").on('click', function(e) {
    // $('#modal_universal').modal('show');
    // $('#modal_universal_header')  .html('test');
    var head = $(this).attr("target-head");
    $('#modal_universal_header').html(head);
    var lnk = $(this).attr("data-summon");
    var _elementClone = $(lnk).html();
    $('#modal_universal_placeholder').html(_elementClone);
});

// $(".modal .close").on('click', function(e) {
//     $('.modal').modal('hide');
// });


$("[data-fetch][data-usemodal]").on('click', function(e) {
    // $('#modal_universal').modal('show');

    var modal = $(this).data("target");
    $(modal).modal('toggle');
    // $('#modal_universal_header')  .html('test');
    var head = $(this).attr("target-head");
    $('#modal_universal_header').html(head);
    var link = $(this).data("fetch");
    // var _elementClone = $(lnk).html();
    $('#modal_universal_placeholder').load(link);
});
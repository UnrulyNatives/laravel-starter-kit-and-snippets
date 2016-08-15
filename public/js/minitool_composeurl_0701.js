// ajax-load append as first in an element
$(document).ready(function() {


    setTimeout(function(){
        // $( "#st-1" ).trigger('click');
        $("#st-1").attr('checked','checked');
        $("#at-1").attr('checked','checked');
    },30);

    setTimeout(function(){
        $("#partial_URL").trigger('click')
    },50);



    $('body').on('click', "#url_builder input:radio", function() {

        setTimeout(function(){
          $(this).attr('checked','checked');
        },5);

        setTimeout(function(){
            var urlbase = $('#partial_URL').data('urlbase');
            var param1 = $(this).data('param1');
            var param2 = $(this).data('param2');
            var sourceform = $('#url_builder');

            var sw1 = $( "#url_builder input:radio[name=standpointed]:checked" ).val();
            var sw2 = $( "#url_builder input:radio[name=attituded]:checked" ).val();
            // $(this).attr("data-load", urlbase + "/" + sw1 + "/" + sw2);
            $('#partial_URL').attr("data-load", urlbase + "/" + sw1 + "/" + sw2);
            $('#partial_URL').attr("title", urlbase + "/" + sw1 + "/" + sw2);

            $("#partial_URL").trigger('click')
        },30);

    });


});

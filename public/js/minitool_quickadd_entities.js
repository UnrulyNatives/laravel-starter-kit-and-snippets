jQuery(document).ready(function($) {
    $('#form-quickadd-entities').on('submit', function() {
        // preventDefault();
        // return false;
        //.....
        //show some spinner etc to indicate operation in progress
        //.....
        $.post($(this).prop('action'), {
            "_token": $(this).find('input[name=_token]').val(),
            "name": $(this).find('input[name=name]').val(),
            "founding_country_id": $(this).find('input[name=founding_country_id]').val(),
            "itemtype_id": $(this).find('input[name=itemtype_id]').val(),
            // "confirmation_URL": $( '#confirmation_URL' ).val(),
            "setting_value": $('#setting_value').val()
        }, function(data) {
            $('#entity_place').replaceWith(data.new_entity_id);
            var entityid = $("#entity_id").val();
            $('#entity_newid').text(data.new_id);
            $('#entity_name').text(data.new_entity);
            $('#entity_country').text(data.new_country);
            $('#entity_newid').addClass('ui button green');
            $('#entity_name').addClass('ui button red');
            $('#entity_country').addClass('ui button blue');


            $('#blank_entity').remove();
            $('#new_entity_placeholder').removeClass('hidden');
            $('#new_entity_placeholder').addClass('ui segment blue inverted');
            $('#newentity_box a.header').attr('href', 'entities/' + data.new_id + '/edit');
            $('#newentity_box .edit').attr('href', 'entities/' + data.new_id + '/edit');
            $('#newentity_box a.header').text(data.new_entity);
            $('#newentity_box .country').text(data.new_country);
            $('#newentity_box').attr('data-id', data.new_id);
        }, 'json');
        return false;
        //.....
        //do anything else you might want to do
        //.....
    });
});
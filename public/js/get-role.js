(function($) {
'use strict';    
    // role wise permissiom ajax script
    $(document).on('change', '#role', function(){
        var token = $('#token').val();
        $.ajax({
            url : "/get-role-permissions-badge",
            type: 'get',
            data: {
                id : $(this).val(),
                _token : token
            },
            success: function(res)
            {
                $('#permission').html(res);
            },
            error: function()
            {
                alert('failed...');

            }
        });
    });

    $('select').select2();
})(jQuery);

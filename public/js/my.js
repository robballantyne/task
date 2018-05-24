var brewtifulScripts = (function ($) {

    // Set the new view type in the session and reload.
    var switchView = function(type)
    {
        $.post('/ajax/viewswitch',
            {
                '_token': $('meta[name=csrf-token]').attr('content'),
                viewtype: type,
            })
            .done(function() {
                location.reload();
            })
            .fail(function() {
                //
            })
            .always(function() {
                //
            });
    };

    return {
        switchView: switchView,
    }

})(jQuery);

// invoke script to switch the view
$(document).on("click", ".btn.view-switch", function() {
    brewtifulScripts.switchView($(this).attr('data-view'));
});
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

    // Toggle the relationship between beer and user
    var toggleFavouriteUserBeer = function($target, remove)
    {
        $.post('/ajax/togglefavourite',
            {
                '_token': $('meta[name=csrf-token]').attr('content'),
                beer_id: $target.attr('data-beer-id'),
            })
            .done(function(data) {
                if (data.favourite === "1") {
                    $target.addClass('favourite');
                } else {
                    $target.removeClass('favourite');
                }
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
        toggleFavouriteUserBeer: toggleFavouriteUserBeer,
    }

})(jQuery);

// invoke script to switch the view
$(document).on("click", ".btn.view-switch", function() {
    brewtifulScripts.switchView($(this).attr('data-view'));
});

// invoke script to toggle favourites
$(document).on("click", ".btn.fav-toggle", function(e) {
    brewtifulScripts.toggleFavouriteUserBeer($(this));
    e.preventDefault();
});

(function ($) {

// Keep the last visited page upon refresh
    var urlItem = window.location.hash,
        currentItem = null,
        menuItems = $('.nav-stacked li');

    if(urlItem && urlItem.length > 0){
        currentItem = $(urlItem + '_menu_item');
    }

    // If there is an item to be activated
    if(currentItem && currentItem.length > 0)
    {
    	// Remove all active
    	menuItems.removeClass('wp-ui-highlight');
        // Activate the current menu item
        currentItem.addClass('wp-ui-highlight');

        var tab = currentItem.children().attr('href');
		if ( $('.tab-pane.active').length > 0 ) {
			$('.tab-pane.active').fadeOut('fast',function(){
				$(tab).fadeIn('fast').addClass('active');
			}).removeClass('active');
		}
		else {
			$(tab).fadeIn('fast').addClass('active');
		}
    }


// ACTIVATE THE MENU
	$('.nav-stacked li').click(function() {

		if ( $(this).is('.wp-ui-highlight') ) {
			return false;
		}

		var tab = $(this).children().attr('href');
		window.location.hash = $(this).children().attr('href'); // Update hash
		$('.nav-stacked li.wp-ui-highlight').removeClass('wp-ui-highlight');
		$(this).addClass('wp-ui-highlight');
		if ( $('.tab-pane.active').length > 0 ) {
			$('.tab-pane.active').fadeOut('fast',function(){
				$(tab).fadeIn('fast').addClass('active');
			}).removeClass('active');
		}
		else {
			$(tab).fadeIn('fast').addClass('active');
		}

		return false;
	});

// END ACTIVATE THE MENU

// SAVE THE OPTIONS
	var optionsForm = jQuery('#zn_options_form');
	optionsForm.on('click','.zn_save',function() {
		var data = jQuery('#zn_options_form').serialize() + '&zn_ajax_nonce=' + ZnAjax.security;
		// add class while saving
		optionsForm.addClass('zn-is-saving');

		jQuery.post(ajaxurl, data, function(response) {

			if (response) {
				new $.ZnModalMessage('Settings saved successfully !');
				optionsForm.removeClass('zn-is-saving');
			}

		});

	return false;

	});

// END SAVE THE OPTIONS

})(jQuery);